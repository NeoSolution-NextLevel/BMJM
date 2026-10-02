<?php
include_once __DIR__ . '/../../imports/need/session_setup.php';
include_once __DIR__ . '/../../imports/need/DB.php';
include_once __DIR__ . '/../../Controller/financial_report/financial_report_LIST.php';
include_once __DIR__ . '/../../Controller/income_expence_type/income_expence_type_LIST.php';

$json = array(
    'summary'           => array(),
    'monthly_breakdown'  => array(),
    'total_income'       => 0,
    'total_expense'      => 0,
    'net_balance'        => 0,
    'report_period'      => ''
);

$report_type  = isset($_POST['report_type'])  ? $_POST['report_type']  : 'custom';
$start_date   = isset($_POST['start_date'])   ? $_POST['start_date']   : '';
$end_date     = isset($_POST['end_date'])     ? $_POST['end_date']     : '';
$report_year  = isset($_POST['report_year'])  ? intval($_POST['report_year'])  : intval(date('Y'));
$report_month = isset($_POST['report_month']) ? intval($_POST['report_month']) : 0;

$month_names_full = ['','January','February','March','April','May','June','July','August','September','October','November','December'];
$month_names_short = ['','Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];

if ($report_type === 'yearly') {
    $json['report_period'] = 'Full Year ' . $report_year;
} elseif ($report_type === 'monthly') {
    $json['report_period'] = ($month_names_full[$report_month] ?? 'Month ' . $report_month) . ' ' . $report_year;
} else {
    $json['report_period'] = ($start_date && $end_date)
        ? date('d M Y', strtotime($start_date)) . ' – ' . date('d M Y', strtotime($end_date))
        : 'All Time';
}

$apply_date_filters = function(financial_report_LIST $obj) use ($report_type, $start_date, $end_date, $report_year, $report_month) {
    if ($report_type === 'yearly') {
        $obj->filter_by_year($report_year);
    } elseif ($report_type === 'monthly') {
        $obj->filter_by_year($report_year);
        $obj->filter_by_month($report_month);
    } else {
        if (!empty($start_date) && !empty($end_date)) {
            $obj->filter_by_date_range($start_date, $end_date);
        }
    }
};

// PER-CATEGORY SUMMARY
$type_list_obj = new income_expence_type_LIST();
$type_list_obj->get_all_data();
$type_result = $type_list_obj->get_result();

$total_income  = 0;
$total_expense = 0;

if ($type_result) {
    while ($type_row = $type_result->fetch_assoc()) {
        $type_id    = $type_row['id'];
        $type_name  = $type_row['income_expence_type_name'];
        $is_income  = intval($type_row['is_income_type']) === 1;
        $is_expense = intval($type_row['is_expece_type']) === 1;

        // Query detail transactions for this type
        $amount_obj = new financial_report_LIST();
        $amount_obj->get_all_data();
        $amount_obj->filter_by_income_expence_type_id($type_id);

        // Also filter by income/expense flag to avoid cross-contamination
        if ($is_income) {
            $amount_obj->filter_by_is_type_of_income();
        } elseif ($is_expense) {
            $amount_obj->filter_by_is_type_of_expence();
        }

        $apply_date_filters($amount_obj);
        $amount_result = $amount_obj->get_result();

        $type_total = 0;
        $tx_count   = 0;
        if ($amount_result) {
            while ($a_row = $amount_result->fetch_assoc()) {
                $type_total += floatval($a_row['amount']);
                $tx_count++;
            }
        }

        // Determine kind
        if ($is_income) {
            $total_income += $type_total;
            $kind = 'income';
        } elseif ($is_expense) {
            $total_expense += $type_total;
            $kind = 'expense';
        } else {
            $kind = 'other';
        }

        // Include ALL categories (even zero-amount) so user sees full picture
        $json['summary'][] = array(
            'type_id'    => $type_id,
            'type_name'  => $type_name,
            'kind'       => $kind,
            'total'      => $type_total,
            'tx_count'   => $tx_count
        );
    }
}

//MONTHLY BREAKDOWN
$month_names = $month_names_short;

if ($report_type === 'monthly') {
    // Single bar for the chosen month
    $inc_obj = new financial_report_LIST();
    $inc_obj->get_all_data();
    $inc_obj->filter_by_is_type_of_income();
    $inc_obj->filter_by_year($report_year);
    $inc_obj->filter_by_month($report_month);
    $inc_result   = $inc_obj->get_result();
    $month_income = 0;
    if ($inc_result) while ($r = $inc_result->fetch_assoc()) $month_income += floatval($r['amount']);

    $exp_obj = new financial_report_LIST();
    $exp_obj->get_all_data();
    $exp_obj->filter_by_is_type_of_expence();
    $exp_obj->filter_by_year($report_year);
    $exp_obj->filter_by_month($report_month);
    $exp_result    = $exp_obj->get_result();
    $month_expense = 0;
    if ($exp_result) while ($r = $exp_result->fetch_assoc()) $month_expense += floatval($r['amount']);

    $json['monthly_breakdown'][] = array(
        'label'   => ($month_names[$report_month] ?? 'M' . $report_month) . ' ' . $report_year,
        'income'  => $month_income,
        'expense' => $month_expense,
        'net'     => $month_income - $month_expense
    );

} elseif ($report_type === 'yearly') {
    for ($m = 1; $m <= 12; $m++) {
        $inc_obj = new financial_report_LIST();
        $inc_obj->get_all_data();
        $inc_obj->filter_by_is_type_of_income();
        $inc_obj->filter_by_year($report_year);
        $inc_obj->filter_by_month($m);
        $inc_result   = $inc_obj->get_result();
        $month_income = 0;
        if ($inc_result) while ($r = $inc_result->fetch_assoc()) $month_income += floatval($r['amount']);

        $exp_obj = new financial_report_LIST();
        $exp_obj->get_all_data();
        $exp_obj->filter_by_is_type_of_expence();
        $exp_obj->filter_by_year($report_year);
        $exp_obj->filter_by_month($m);
        $exp_result    = $exp_obj->get_result();
        $month_expense = 0;
        if ($exp_result) while ($r = $exp_result->fetch_assoc()) $month_expense += floatval($r['amount']);

        $json['monthly_breakdown'][] = array(
            'label'   => $month_names[$m] . ' ' . $report_year,
            'income'  => $month_income,
            'expense' => $month_expense,
            'net'     => $month_income - $month_expense
        );
    }

} else {
    // Custom date range — iterate months between start and end
    if (!empty($start_date) && !empty($end_date)) {
        $start_ts = strtotime($start_date);
        $end_ts   = strtotime($end_date);
        $cursor   = $start_ts;
        while ($cursor <= $end_ts) {
            $y = intval(date('Y', $cursor));
            $m = intval(date('n', $cursor));

            $inc_obj = new financial_report_LIST();
            $inc_obj->get_all_data();
            $inc_obj->filter_by_is_type_of_income();
            $inc_obj->filter_by_year($y);
            $inc_obj->filter_by_month($m);
            $inc_result   = $inc_obj->get_result();
            $month_income = 0;
            if ($inc_result) while ($r = $inc_result->fetch_assoc()) $month_income += floatval($r['amount']);

            $exp_obj = new financial_report_LIST();
            $exp_obj->get_all_data();
            $exp_obj->filter_by_is_type_of_expence();
            $exp_obj->filter_by_year($y);
            $exp_obj->filter_by_month($m);
            $exp_result    = $exp_obj->get_result();
            $month_expense = 0;
            if ($exp_result) while ($r = $exp_result->fetch_assoc()) $month_expense += floatval($r['amount']);

            $json['monthly_breakdown'][] = array(
                'label'   => ($month_names[$m] ?? 'M' . $m) . ' ' . $y,
                'income'  => $month_income,
                'expense' => $month_expense,
                'net'     => $month_income - $month_expense
            );

            $cursor = strtotime('+1 month', mktime(0, 0, 0, $m, 1, $y));
        }
    }
}

// TOTALS
$json['total_income']  = $total_income;
$json['total_expense'] = $total_expense;
$json['net_balance']   = $total_income - $total_expense;

echo json_encode($json);
?>
