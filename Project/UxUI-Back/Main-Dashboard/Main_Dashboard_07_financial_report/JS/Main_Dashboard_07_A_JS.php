<script type="text/javascript">

  var financialReportData = null;

  function financialReportClose() {
    if (typeof main_dashboard_00_OPEN === 'function') {
      main_dashboard_00_OPEN();
    } else {
      window.location.href = "<?php echo $pth; ?>UxUi/Main-Dashboard.php";
    }
  }

  function financialReportDownloadPDF(button) {
    var jsPDFConstructor = window.jspdf && window.jspdf.jsPDF;
    if (typeof jsPDFConstructor !== 'function') {
      window.alert('PDF export is unavailable. Check your internet connection and try again.');
      return;
    }
    if (!financialReportData) {
      window.alert('Generate a report before downloading the PDF.');
      return;
    }

    if (button) button.disabled = true;

    var logoElement = document.querySelector('#Main_Dashboard_07_A .rpt-document-logo');
    var createPDF = function() {
      try {
        var logoData = null;
        if (logoElement && logoElement.naturalWidth > 0) {
          var logoCanvas = document.createElement('canvas');
          logoCanvas.width = logoElement.naturalWidth;
          logoCanvas.height = logoElement.naturalHeight;
          logoCanvas.getContext('2d').drawImage(logoElement, 0, 0);
          logoData = logoCanvas.toDataURL('image/png');
        }

        var pdf = new jsPDFConstructor({orientation: 'portrait', unit: 'mm', format: 'a4'});
        var pageWidth = pdf.internal.pageSize.getWidth();
        var pageHeight = pdf.internal.pageSize.getHeight();
        var margin = 12;
        var contentWidth = pageWidth - margin * 2;
        var footerTop = pageHeight - 16;
        var period = String(financialReportData.report_period || 'Financial Report').replace(/[\u2013\u2014]/g, '-');
        var generatedDate = new Date().toLocaleDateString('en-GB', {day: '2-digit', month: 'long', year: 'numeric'});
        var currentY = 0;

        function formatAmount(amount) {
          var value = parseFloat(amount) || 0;
          return 'LKR ' + value.toLocaleString('en-LK', {minimumFractionDigits: 2, maximumFractionDigits: 2});
        }

        function drawPageHeader(isContinuation) {
          pdf.setFillColor(247, 248, 245);
          pdf.rect(margin, 10, contentWidth, 25, 'F');
          if (logoData) pdf.addImage(logoData, 'PNG', margin + 3, 12, 24, 19);

          pdf.setTextColor(11, 46, 36);
          pdf.setFont('helvetica', 'bold');
          pdf.setFontSize(10);
          pdf.text('BAMBALAPITIYA JUMMA MOSQUE', margin + 31, 17);
          pdf.setFont('helvetica', 'normal');
          pdf.setFontSize(7);
          pdf.setTextColor(90, 106, 98);
          pdf.text('Bambalapitiya, Colombo, Sri Lanka', margin + 31, 22);
          pdf.text('www.bmjm.lk | 011 771 0877 | info@bmjm.lk', margin + 31, 27);

          pdf.setTextColor(11, 46, 36);
          pdf.setFont('helvetica', 'bold');
          pdf.setFontSize(9);
          pdf.text('FINANCIAL REPORT', pageWidth - margin - 3, 16, {align: 'right'});
          pdf.setFont('helvetica', 'normal');
          pdf.setFontSize(7);
          pdf.setTextColor(90, 106, 98);
          pdf.text(pdf.splitTextToSize(period, 62), pageWidth - margin - 3, 21, {align: 'right'});
          pdf.setFontSize(6.5);
          pdf.setTextColor(139, 151, 143);
          pdf.text('Prepared ' + generatedDate, pageWidth - margin - 3, 30, {align: 'right'});

          pdf.setDrawColor(201, 162, 39);
          pdf.setLineWidth(0.7);
          pdf.line(margin, 37, pageWidth - margin, 37);
          pdf.setFillColor(18, 56, 50);
          pdf.rect(margin, 40, contentWidth, 9, 'F');
          pdf.setTextColor(255, 255, 255);
          pdf.setFont('helvetica', 'bold');
          pdf.setFontSize(8);
          pdf.text(isContinuation ? 'FINANCIAL REPORT | CONTINUED' : 'INCOME & EXPENSE ANALYSIS', margin + 4, 46);
        }

        function drawKpiCard(x, label, value, color, background) {
          var cardWidth = (contentWidth - 8) / 3;
          pdf.setFillColor(background[0], background[1], background[2]);
          pdf.setDrawColor(230, 224, 208);
          pdf.roundedRect(x, 55, cardWidth, 25, 2, 2, 'FD');
          pdf.setTextColor(139, 151, 143);
          pdf.setFont('helvetica', 'bold');
          pdf.setFontSize(6.5);
          pdf.text(label.toUpperCase(), x + 3, 61);
          pdf.setTextColor(color[0], color[1], color[2]);
          pdf.setFontSize(10);
          pdf.text(value, x + 3, 69);
          pdf.setTextColor(90, 106, 98);
          pdf.setFont('helvetica', 'normal');
          pdf.setFontSize(6);
          pdf.text(period, x + 3, 76);
        }

        var cardWidth = (contentWidth - 8) / 3;
        drawPageHeader(false);
        drawKpiCard(margin, 'Total Income', formatAmount(financialReportData.total_income), [27, 122, 74], [241, 248, 244]);
        drawKpiCard(margin + cardWidth + 4, 'Total Expenses', formatAmount(financialReportData.total_expense), [176, 69, 58], [251, 244, 243]);
        var netBalance = parseFloat(financialReportData.net_balance) || 0;
        drawKpiCard(margin + (cardWidth + 4) * 2, 'Net Balance', formatAmount(netBalance), netBalance < 0 ? [176, 69, 58] : [27, 122, 74], [245, 247, 246]);

        var columns = [margin, margin + 80, margin + 108, margin + 139, margin + contentWidth];
        function drawTableHeader() {
          pdf.setFillColor(242, 239, 230);
          pdf.rect(margin, currentY, contentWidth, 8, 'F');
          pdf.setFont('helvetica', 'bold');
          pdf.setFontSize(7);
          pdf.setTextColor(90, 106, 98);
          pdf.text('CATEGORY', columns[0] + 2, currentY + 5.2);
          pdf.text('TYPE', columns[1] + 2, currentY + 5.2);
          pdf.text('TRANSACTIONS', columns[3] - 2, currentY + 5.2, {align: 'right'});
          pdf.text('AMOUNT (LKR)', columns[4] - 2, currentY + 5.2, {align: 'right'});
          currentY += 8;
        }

        function startContinuationPage(sectionLabel) {
          pdf.addPage();
          drawPageHeader(true);
          currentY = 55;
          pdf.setFont('helvetica', 'bold');
          pdf.setFontSize(8);
          pdf.setTextColor(90, 106, 98);
          pdf.text(sectionLabel + ' | CONTINUED', margin, currentY);
          currentY += 4;
          drawTableHeader();
        }

        function startChartPage() {
          pdf.addPage();
          drawPageHeader(true);
          currentY = 55;
        }

        function ensureTableSpace(height, sectionLabel) {
          if (currentY + height > footerTop - 2) startContinuationPage(sectionLabel);
        }

        currentY = 89;
        pdf.setTextColor(35, 66, 55);
        pdf.setFont('helvetica', 'bold');
        pdf.setFontSize(8);
        pdf.text('CATEGORY BREAKDOWN', margin, currentY);
        currentY += 4;
        drawTableHeader();

        var summary = Array.isArray(financialReportData.summary) ? financialReportData.summary.slice() : [];
        var incomeRows = summary.filter(function(row) { return row.kind === 'income'; });
        var expenseRows = summary.filter(function(row) { return row.kind === 'expense'; });
        var otherRows = summary.filter(function(row) { return row.kind !== 'income' && row.kind !== 'expense'; });
        var totalTransactions = 0;

        function sortByAmount(left, right) {
          return (parseFloat(right.total) || 0) - (parseFloat(left.total) || 0);
        }
        incomeRows.sort(sortByAmount);
        expenseRows.sort(sortByAmount);
        otherRows.sort(sortByAmount);

        function drawCategoryGroup(label, rows, color, tint, sectionLabel) {
          if (!rows.length) return;
          ensureTableSpace(7, sectionLabel);
          pdf.setFillColor(tint[0], tint[1], tint[2]);
          pdf.rect(margin, currentY, contentWidth, 7, 'F');
          pdf.setTextColor(color[0], color[1], color[2]);
          pdf.setFont('helvetica', 'bold');
          pdf.setFontSize(6.5);
          pdf.text(label, margin + 2, currentY + 4.7);
          currentY += 7;

          rows.forEach(function(row) {
            var categoryLines = pdf.splitTextToSize(String(row.type_name || 'Uncategorized'), 75);
            var rowHeight = Math.max(8, categoryLines.length * 3.6 + 3);
            ensureTableSpace(rowHeight, sectionLabel);
            pdf.setDrawColor(230, 224, 208);
            pdf.setLineWidth(0.2);
            pdf.line(margin, currentY + rowHeight, pageWidth - margin, currentY + rowHeight);
            pdf.setTextColor(30, 43, 38);
            pdf.setFont('helvetica', 'normal');
            pdf.setFontSize(7);
            pdf.text(categoryLines, columns[0] + 2, currentY + 4.8);

            var kindLabel = row.kind === 'income' ? 'Income' : (row.kind === 'expense' ? 'Expense' : 'Other');
            pdf.setTextColor(row.kind === 'income' ? 27 : (row.kind === 'expense' ? 176 : 90), row.kind === 'income' ? 122 : (row.kind === 'expense' ? 69 : 106), row.kind === 'income' ? 74 : (row.kind === 'expense' ? 58 : 98));
            pdf.text(kindLabel, columns[1] + 2, currentY + 4.8);

            var transactionCount = parseInt(row.tx_count, 10) || 0;
            var amount = parseFloat(row.total) || 0;
            totalTransactions += transactionCount;
            pdf.setTextColor(30, 43, 38);
            pdf.text(String(transactionCount), columns[3] - 2, currentY + 4.8, {align: 'right'});

            var amountPrefix = amount > 0 && row.kind === 'income' ? '+ ' : (amount > 0 && row.kind === 'expense' ? '- ' : '');
            pdf.setTextColor(row.kind === 'income' ? 27 : (row.kind === 'expense' ? 176 : 30), row.kind === 'income' ? 122 : (row.kind === 'expense' ? 69 : 43), row.kind === 'income' ? 74 : (row.kind === 'expense' ? 58 : 38));
            pdf.setFont('helvetica', 'bold');
            pdf.text(amountPrefix + formatAmount(Math.abs(amount)), columns[4] - 2, currentY + 4.8, {align: 'right'});
            currentY += rowHeight;
          });
        }

        if (!summary.length) {
          pdf.setTextColor(90, 106, 98);
          pdf.setFont('helvetica', 'normal');
          pdf.setFontSize(8);
          pdf.text('No transactions found for the selected period.', margin + 2, currentY + 6);
          currentY += 10;
        } else {
          drawCategoryGroup('INCOME CATEGORIES', incomeRows, [27, 122, 74], [241, 248, 244], 'CATEGORY BREAKDOWN');
          drawCategoryGroup('EXPENSE CATEGORIES', expenseRows, [176, 69, 58], [251, 244, 243], 'CATEGORY BREAKDOWN');
          drawCategoryGroup('OTHER CATEGORIES', otherRows, [90, 106, 98], [246, 247, 246], 'CATEGORY BREAKDOWN');
          ensureTableSpace(9, 'CATEGORY BREAKDOWN');
          pdf.setFillColor(247, 248, 245);
          pdf.rect(margin, currentY, contentWidth, 9, 'F');
          pdf.setTextColor(30, 43, 38);
          pdf.setFont('helvetica', 'bold');
          pdf.setFontSize(7);
          pdf.text('NET BALANCE', columns[0] + 2, currentY + 5.8);
          pdf.text(totalTransactions + ' tx', columns[3] - 2, currentY + 5.8, {align: 'right'});
          pdf.setTextColor(netBalance < 0 ? 176 : 27, netBalance < 0 ? 69 : 122, netBalance < 0 ? 58 : 74);
          pdf.text(formatAmount(Math.abs(netBalance)) + (netBalance < 0 ? ' (deficit)' : ''), columns[4] - 2, currentY + 5.8, {align: 'right'});
          currentY += 9;
        }

        var monthlyBreakdown = Array.isArray(financialReportData.monthly_breakdown) ? financialReportData.monthly_breakdown : [];
        if (monthlyBreakdown.length) {
          var chartHeight = 76;
          if (currentY + chartHeight > footerTop - 2) startChartPage();
          currentY += 8;
          pdf.setTextColor(35, 66, 55);
          pdf.setFont('helvetica', 'bold');
          pdf.setFontSize(8);
          pdf.text('INCOME VS EXPENSES', margin, currentY);

          var plotTop = currentY + 7;
          var baseline = plotTop + 42;
          var plotLeft = margin + 4;
          var plotRight = pageWidth - margin - 4;
          var plotWidth = plotRight - plotLeft;
          var maxValue = 1;
          monthlyBreakdown.forEach(function(month) {
            maxValue = Math.max(maxValue, parseFloat(month.income) || 0, parseFloat(month.expense) || 0);
          });

          pdf.setDrawColor(225, 229, 225);
          pdf.setLineWidth(0.2);
          for (var gridLine = 0; gridLine < 4; gridLine++) {
            var gridY = plotTop + 4 + gridLine * 12;
            pdf.line(plotLeft, gridY, plotRight, gridY);
          }

          var slotWidth = plotWidth / monthlyBreakdown.length;
          var barWidth = Math.min(4, Math.max(2, slotWidth * 0.22));
          monthlyBreakdown.forEach(function(month, index) {
            var centerX = plotLeft + slotWidth * (index + 0.5);
            var incomeHeight = Math.max(0.5, ((parseFloat(month.income) || 0) / maxValue) * 34);
            var expenseHeight = Math.max(0.5, ((parseFloat(month.expense) || 0) / maxValue) * 34);
            pdf.setFillColor(27, 122, 74);
            pdf.rect(centerX - barWidth - 0.6, baseline - incomeHeight, barWidth, incomeHeight, 'F');
            pdf.setFillColor(176, 69, 58);
            pdf.rect(centerX + 0.6, baseline - expenseHeight, barWidth, expenseHeight, 'F');
            pdf.setDrawColor(90, 106, 98);
            pdf.line(centerX - slotWidth / 2 + 1, baseline, centerX + slotWidth / 2 - 1, baseline);
            pdf.setTextColor(90, 106, 98);
            pdf.setFont('helvetica', 'normal');
            pdf.setFontSize(monthlyBreakdown.length > 8 ? 5 : 6);
            pdf.text(String(month.label || ''), centerX, baseline + 4, {align: 'center', maxWidth: Math.max(8, slotWidth - 1)});
          });

          var legendY = baseline + 12;
          pdf.setFillColor(27, 122, 74);
          pdf.circle(margin + 5, legendY - 1, 1.5, 'F');
          pdf.setTextColor(90, 106, 98);
          pdf.setFontSize(6.5);
          pdf.text('Income', margin + 8, legendY);
          pdf.setFillColor(176, 69, 58);
          pdf.circle(margin + 31, legendY - 1, 1.5, 'F');
          pdf.text('Expenses', margin + 34, legendY);
          currentY = legendY + 5;
        }

        var pageCount = pdf.internal.getNumberOfPages();
        for (var pageNumber = 1; pageNumber <= pageCount; pageNumber++) {
          pdf.setPage(pageNumber);
          pdf.setDrawColor(18, 56, 50);
          pdf.setLineWidth(0.35);
          pdf.line(margin, pageHeight - 13, pageWidth - margin, pageHeight - 13);
          pdf.setFont('helvetica', 'normal');
          pdf.setFontSize(6.5);
          pdf.setTextColor(90, 106, 98);
          pdf.text('BAMBALAPITIYA JUMMA MOSQUE | www.bmjm.lk | 011 771 0877 | info@bmjm.lk', margin, pageHeight - 8);
          pdf.text('Page ' + pageNumber + ' of ' + pageCount, pageWidth - margin, pageHeight - 8, {align: 'right'});
        }

        var safePeriod = period.replace(/[^a-z0-9]+/gi, '-').replace(/^-|-$/g, '') || 'report';
        pdf.save('BMJM-Financial-Report-' + safePeriod + '.pdf');
      } catch (error) {
        console.error('Financial report PDF export failed:', error);
        window.alert('The PDF could not be created. Please try again.');
      } finally {
        if (button) button.disabled = false;
      }
    };

    if (logoElement && !logoElement.complete) {
      logoElement.addEventListener('load', createPDF, {once: true});
      logoElement.addEventListener('error', createPDF, {once: true});
    } else {
      createPDF();
    }
  }

  function rptToggleFilters() {
    var type = document.getElementById('rpt-type').value;

    document.getElementById('rpt-field-start').style.display  = (type === 'custom')  ? '' : 'none';
    document.getElementById('rpt-field-end').style.display    = (type === 'custom')  ? '' : 'none';
    document.getElementById('rpt-field-month').style.display  = (type === 'monthly') ? '' : 'none';
    document.getElementById('rpt-field-year').style.display   = (type !== 'custom')  ? '' : 'none';
  }

  /* ---- Format LKR currency ---- */
  function rptFormatLKR(amount) {
    var num = parseFloat(amount) || 0;
    return 'LKR ' + num.toLocaleString('en-LK', { minimumFractionDigits: 2 });
  }

  function financialReportGenerate() {
    var type = document.getElementById('rpt-type').value;

    var sending_value = {
      report_type:  type,
      start_date:   document.getElementById('rpt-start-date').value,
      end_date:     document.getElementById('rpt-end-date').value,
      report_year:  document.getElementById('rpt-year').value,
      report_month: document.getElementById('rpt-month').value
    };

    $.ajax({
      url: "<?php echo $pth; ?>View-List/Financial_Report/financial_report_summary.php",
      type: "POST",
      data: sending_value,
      dataType: 'json',
      success: function(data) {
        financialReportData = data;
        rptRenderAll(data);
      },
      error: function(xhr, status, error) {
        document.getElementById('rpt-summary-tbody').innerHTML =
          '<tr><td colspan="4" class="rpt-empty" style="color:var(--rpt-danger);">Error establishing connection to backend. Please try again.</td></tr>';
        console.error('Financial report AJAX error:', error);
      },
      complete: function() {
        btn.disabled = false;
        btn.innerHTML = '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><polyline points="23 4 23 10 17 10"/><polyline points="1 20 1 14 7 14"/><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"/></svg> Generate Report';
      }
    });
  }

  function rptRenderAll(data) {
    rptRenderKPI(data);
    rptRenderSummaryTable(data);
    rptRenderBarChart(data);
  }

  function rptRenderKPI(data) {
    var period = data.report_period || '—';
    var documentPeriod = document.getElementById('rpt-document-period');
    if (documentPeriod) documentPeriod.textContent = period;
    document.getElementById('rpt-kpi-income').textContent  = rptFormatLKR(data.total_income);
    document.getElementById('rpt-kpi-expense').textContent = rptFormatLKR(data.total_expense);

    var net = parseFloat(data.net_balance) || 0;
    var netEl = document.getElementById('rpt-kpi-net');
    netEl.textContent = rptFormatLKR(net);
    netEl.style.color = net >= 0 ? 'var(--rpt-success)' : 'var(--rpt-danger)';

    document.getElementById('rpt-kpi-period-income').textContent  = period;
    document.getElementById('rpt-kpi-period-expense').textContent = period;
    document.getElementById('rpt-kpi-period-net').textContent     = period;
  }

  /*Category breakdown table*/
  function rptRenderSummaryTable(data) {
    var tbody  = document.getElementById('rpt-summary-tbody');
    var tfoot  = document.getElementById('rpt-summary-tfoot');
    var summary = data.summary || [];

    if (summary.length === 0) {
      tbody.innerHTML = '<tr><td colspan="4" class="rpt-empty">No transactions found for the selected period.</td></tr>';
      tfoot.style.display = 'none';
      return;
    }

    summary.sort(function(a, b) {
      if (a.kind === b.kind) return b.total - a.total;
      return a.kind === 'income' ? -1 : 1;
    });

    var html = '';
    var totalTx = 0;

    var incomeRows  = summary.filter(function(r){ return r.kind === 'income'; });
    var expenseRows = summary.filter(function(r){ return r.kind === 'expense'; });
    var otherRows   = summary.filter(function(r){ return r.kind !== 'income' && r.kind !== 'expense'; });

    // Sort each group: highest amount first
    function sortDesc(a, b){ return parseFloat(b.total) - parseFloat(a.total); }
    incomeRows.sort(sortDesc);
    expenseRows.sort(sortDesc);

    var html = '';

    function buildRow(row) {
      totalTx += parseInt(row.tx_count) || 0;
      var isIncome   = row.kind === 'income';
      var isExpense  = row.kind === 'expense';
      var badgeClass = isIncome ? 'rpt-badge-income' : (isExpense ? 'rpt-badge-expense' : 'rpt-badge-other');
      var badgeLabel = isIncome ? 'Income' : (isExpense ? 'Expense' : 'Other');
      var amount     = parseFloat(row.total) || 0;
      var amountClass = isIncome ? 'td-income-amount' : (isExpense ? 'td-expense-amount' : '');
      var sign        = (amount > 0 && isIncome) ? '+ ' : (amount > 0 && isExpense) ? '– ' : '';

      html += '<tr>' +
        '<td>' + rptEscape(row.type_name) + '</td>' +
        '<td><span class="rpt-badge ' + badgeClass + '">' + badgeLabel + '</span></td>' +
        '<td class="td-right">' + (parseInt(row.tx_count) || 0) + '</td>' +
        '<td class="td-right ' + amountClass + '">' + sign + rptFormatLKR(amount) + '</td>' +
      '</tr>';
    }

    // Section header: Income
    if (incomeRows.length > 0) {
      html += '<tr style="background:rgba(27,122,74,0.04);">' +
        '<td colspan="4" style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.06em;color:var(--rpt-success);padding:10px 18px 6px;">Income Categories</td>' +
      '</tr>';
      incomeRows.forEach(buildRow);
    }

    // Section header: Expenses
    if (expenseRows.length > 0) {
      html += '<tr style="background:rgba(176,69,58,0.04);">' +
        '<td colspan="4" style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.06em;color:var(--rpt-danger);padding:10px 18px 6px;">Expense Categories</td>' +
      '</tr>';
      expenseRows.forEach(buildRow);
    }

    // Other (neither income nor expense)
    if (otherRows.length > 0) {
      otherRows.forEach(buildRow);
    }

    if (html === '') {
      tbody.innerHTML = '<tr><td colspan="4" class="rpt-empty">No categories configured. Add income / expense types in Settings.</td></tr>';
      tfoot.style.display = 'none';
      return;
    }

    tbody.innerHTML = html;

    var net = parseFloat(data.net_balance) || 0;
    var netClass = net >= 0 ? 'td-net-positive' : 'td-net-negative';
    document.getElementById('rpt-tfoot-tx-count').textContent = totalTx + ' tx';
    document.getElementById('rpt-tfoot-net').innerHTML = '<span class="' + netClass + '">' + rptFormatLKR(Math.abs(net)) + (net < 0 ? ' (deficit)' : '') + '</span>';
    tfoot.style.display = '';
  }

  /* Monthly / Period bar chart */
  function rptRenderBarChart(data) {
    var chartArea  = document.getElementById('rpt-chart-area');
    var barChart   = document.getElementById('rpt-bar-chart');
    var titleEl    = document.getElementById('rpt-chart-title-text');
    var breakdown  = data.monthly_breakdown || [];
    var reportType = document.getElementById('rpt-type').value;

    if (breakdown.length === 0) {
      chartArea.style.display = 'none';
      return;
    }

    // Update chart title based on report type
    if (titleEl) {
      if (reportType === 'monthly') {
        titleEl.textContent = 'Income vs Expenses — ' + (data.report_period || '');
      } else if (reportType === 'yearly') {
        titleEl.textContent = 'Monthly Income vs Expenses';
      } else {
        titleEl.textContent = 'Income vs Expenses by Month';
      }
    }

    // Find max value for proportional bar heights
    var maxVal = 0;
    breakdown.forEach(function(m) {
      maxVal = Math.max(maxVal, parseFloat(m.income) || 0, parseFloat(m.expense) || 0);
    });
    if (maxVal <= 0) maxVal = 1;

    var MAX_BAR_H = 120;

    var html = '';
    breakdown.forEach(function(m) {
      var incVal = parseFloat(m.income)  || 0;
      var expVal = parseFloat(m.expense) || 0;
      var incH   = Math.max(2, Math.round((incVal / maxVal) * MAX_BAR_H));
      var expH   = Math.max(2, Math.round((expVal / maxVal) * MAX_BAR_H));

      html += '<div class="rpt-bar-group">' +
        '<div class="rpt-bar-pair">' +
          '<div class="rpt-bar rpt-bar-income-bar"  style="height:' + incH + 'px;" title="Income: '  + rptFormatLKR(incVal) + '"></div>' +
          '<div class="rpt-bar rpt-bar-expense-bar" style="height:' + expH + 'px;" title="Expense: ' + rptFormatLKR(expVal) + '"></div>' +
        '</div>' +
        '<div class="rpt-bar-label">' + rptEscape(m.label) + '</div>' +
      '</div>';
    });

    barChart.innerHTML = html;
    chartArea.style.display = '';
  }

  function rptEscape(str) {
    var div = document.createElement('div');
    div.appendChild(document.createTextNode(String(str || '')));
    return div.innerHTML;
  }

  $(document).ready(function() {
    var today = new Date();
    var firstDay = new Date(today.getFullYear(), today.getMonth(), 1);
    var fmt = function(d) {
      return d.getFullYear() + '-' +
        String(d.getMonth() + 1).padStart(2, '0') + '-' +
        String(d.getDate()).padStart(2, '0');
    };
    document.getElementById('rpt-start-date').value = fmt(firstDay);
    document.getElementById('rpt-end-date').value   = fmt(today);

    document.getElementById('rpt-month').value = String(today.getMonth() + 1);

    rptToggleFilters();
  });
</script>
