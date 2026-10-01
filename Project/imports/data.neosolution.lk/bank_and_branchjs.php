
<!--bank code and name-->
<input type="hidden" id="get_bank_data_from_neo_solution_bank_name_feild_name">
<input type="hidden" id="get_bank_data_from_neo_solution_bank_code_feild_name">


<!--next feild-->
<input type="hidden" id="get_bank_data_from_neo_solution_next_in_bank_feild_name">
<input type="hidden" id="get_bank_data_from_neo_solution_next_in_branch_feild_name">



<!--bank body-->
<input type="hidden" id="get_bank_data_from_neo_solution_bank_data_body">
<input type="hidden" id="get_bank_data_from_neo_solution_bank_data_main_body">


<script type="text/javascript">
    function set_bank_branch_data_variable(val_01, val_02, val_03, val_04, val_05, val_06, val_07, val_08, val_09, val_10) {
        document.getElementById("get_bank_data_from_neo_solution_bank_name_feild_name").value = val_01;
        document.getElementById("get_bank_data_from_neo_solution_bank_code_feild_name").value = val_02;
        document.getElementById("get_bank_data_from_neo_solution_next_in_bank_feild_name").value = val_03;
        document.getElementById("get_bank_data_from_neo_solution_next_in_branch_feild_name").value = val_04;
        document.getElementById("get_bank_data_from_neo_solution_bank_data_body").value = val_05;
        document.getElementById("get_bank_data_from_neo_solution_bank_data_main_body").value = val_06;



        document.getElementById("get_bank_data_from_neo_solution_branch_data_body").value = val_07;
        document.getElementById("get_bank_data_from_neo_solution_branch_data_main_body").value = val_08;
        document.getElementById("get_bank_data_from_neo_solution_branch_name_feild_name").value = val_09;
        document.getElementById("get_bank_data_from_neo_solution_branch_code_feild_name").value = val_10;

    }



    function get_bank_data_list() {
        ajax_state = false;

        var bank_name_txt_id_obj = document.getElementById("get_bank_data_from_neo_solution_bank_name_feild_name").value;
        var data_body_txt = document.getElementById("get_bank_data_from_neo_solution_bank_data_body").value;
        var data_main_body_txt = document.getElementById("get_bank_data_from_neo_solution_bank_data_main_body").value;

        var sending_value = "get_bank_name=" + document.getElementById(bank_name_txt_id_obj).value;

        var data_body_obj = document.getElementById(data_body_txt);
        $(data_body_obj).empty();

        var data_main_body_obj = document.getElementById(data_main_body_txt);
        data_main_body_obj.style.display = "block";




        $.ajax({
            url: "<?php echo $pth; ?>View-List/DataNeoSolutionLK/data_bank_name_list.php",
            type: 'POST',
            data: sending_value,
            cache: false,
            success: function (data, textStatus, jqXHR) {
//                                                alert(data);
                var json = eval(data);
                for (var i = 0; i < json.length; i++) {
                    get_bank_data_list_body(data_body_obj, json[i].bank_name, json[i].bank_code);
                }
            }
        });
        ajax_state = true;
    }

    function get_bank_data_list_body(get_body, bank_name, bank_code) {


        var row = document.createElement("div");
        row.setAttribute("class", "row w3-border-bottom w3-border-theme w3-hover-theme");
        var col_01 = document.createElement("div");
        col_01.setAttribute("class", "col-lg-8 w3-padding w3-strong ");
        col_01.appendChild(document.createTextNode(bank_name));

        var col_02 = document.createElement("div");
        col_02.setAttribute("class", "col-lg-4 w3-padding w3-strong w3-hover-theme");
        col_02.appendChild(document.createTextNode(bank_code));
        row.appendChild(col_01);
        row.appendChild(col_02);
        get_body.appendChild(row);

        row.addEventListener("click", function () {
            get_bank_data_list_body_set_data(bank_name, bank_code, "1");
        });
    }
    function get_bank_data_list_body_set_data(name, code, type) {

        var bank_name_id_obj = document.getElementById("get_bank_data_from_neo_solution_bank_name_feild_name");
        var bank_code_id_obj = document.getElementById("get_bank_data_from_neo_solution_bank_code_feild_name");

        var bank_branch_id_obj = document.getElementById("get_bank_data_from_neo_solution_branch_name_feild_name");
        var bank_brach_code_id_obj = document.getElementById("get_bank_data_from_neo_solution_branch_code_feild_name");

        var data_body_id_obj = document.getElementById("get_bank_data_from_neo_solution_bank_data_body");
        var data_main_body_id_obj = document.getElementById("get_bank_data_from_neo_solution_bank_data_main_body");
        var next_text_feild_id = document.getElementById("get_bank_data_from_neo_solution_next_feild_name");


        document.getElementById(bank_name_id_obj.value).value = name;
        document.getElementById(bank_code_id_obj.value).value = code;

        var data_main_body_obj = document.getElementById(data_main_body_id_obj.value);
        data_main_body_obj.style.display = "none";


        document.getElementById(bank_branch_id_obj.value).disabled = false;
        document.getElementById(bank_brach_code_id_obj.value).disabled = false;

        const next_feild_txt_obj = document.getElementById(next_text_feild_id.value);
        if (next_feild_txt_obj) {
            next_feild_txt_obj.focus();
            next_feild_txt_obj.setSelectionRange(0, 0); // Set the caret position if needed
        }

    }

</script>



<!--branch data js-->




<!--brach body-->
<input type="hidden" id="get_bank_data_from_neo_solution_branch_data_body">
<input type="hidden" id="get_bank_data_from_neo_solution_branch_data_main_body">



<!--name and code branch-->
<input type="hidden" id="get_bank_data_from_neo_solution_branch_name_feild_name">
<input type="hidden" id="get_bank_data_from_neo_solution_branch_code_feild_name">



<script type="text/javascript">
    function get_barnch_data_list() {
        ajax_state = false;
        var bank_code_txt_id_obj = document.getElementById("get_bank_data_from_neo_solution_bank_code_feild_name");

        var bank_name_txt_id_obj = document.getElementById("get_bank_data_from_neo_solution_bank_name_feild_name");
        var bank_branch_name_id_obj = document.getElementById("get_bank_data_from_neo_solution_branch_name_feild_name");
        var bank_brach_code_id_obj = document.getElementById("get_bank_data_from_neo_solution_branch_code_feild_name");
        var data_bank_code_body_txt = document.getElementById("get_bank_data_from_neo_solution_branch_data_body");
        var data_main_body_txt = document.getElementById("get_bank_data_from_neo_solution_branch_data_main_body");

        ajax_state = false;

        var branch_main_body_obj = document.getElementById(data_main_body_txt.value);
        branch_main_body_obj.style.display = "block";

        var brach__data_body_obj = document.getElementById(data_bank_code_body_txt.value);
        $(brach__data_body_obj).empty();

        var sending_value = "bank_code=" + document.getElementById(bank_code_txt_id_obj.value).value + "&bank_branch_name=" + document.getElementById(bank_brach_code_id_obj.value).value;
//                                    alert(sending_value);
        $.ajax({
            url: "<?php echo $pth; ?>View-List/DataNeoSolutionLK/data_bank_branch_code.php",
            type: 'POST',
            data: sending_value,
            cache: false,
            success: function (data, textStatus, jqXHR) {
//                                            alert(data);
                var json = eval(data);
                for (var i = 0; i < json.length; i++) {
                    get_barnch_data_list_body(json[i].branch_name, json[i].branch_code_no);
//                                                break;
                }
            }
        });
        ajax_state = true;
    }

    function  get_barnch_data_list_body(branch_name, branch_code) {
//                                    alert(branch_name + " --- " + branch_code);
        var data_body_txt = document.getElementById("get_bank_data_from_neo_solution_branch_data_body");


        var data_body_obj = document.getElementById(data_body_txt.value);
//                                    alert("1");
        var row = document.createElement("div");
        row.setAttribute("class", "row w3-border-bottom w3-border-theme w3-hover-theme");
        var col_01 = document.createElement("div");
        col_01.setAttribute("class", "col-lg-8 w3-padding w3-strong ");
        col_01.appendChild(document.createTextNode(branch_name));
//                                    alert("2");
        var col_02 = document.createElement("div");
        col_02.setAttribute("class", "col-lg-4 w3-padding w3-strong w3-hover-theme");
        col_02.appendChild(document.createTextNode(branch_code));
        row.appendChild(col_01);
        row.appendChild(col_02);
        data_body_obj.appendChild(row);
//                                    alert("3");
        row.addEventListener("click", function () {
            get_barnch_data_list_body_set_data(branch_name, branch_code);
        });
//                                    alert("4");
    }
    function get_barnch_data_list_body_set_data(branch_name, branch_code) {
        var branch_name_obj = document.getElementById("get_bank_data_from_neo_solution_branch_name_feild_name");
        var branch_code_obj = document.getElementById("get_bank_data_from_neo_solution_branch_code_feild_name");
        var main_body_obj = document.getElementById("get_bank_data_from_neo_solution_branch_data_main_body");

        document.getElementById(branch_name_obj.value).value = branch_name;
        document.getElementById(branch_code_obj.value).value = branch_code;
        var main_data_body_obj = document.getElementById(main_body_obj.value);
        main_data_body_obj.style.display = "none";
    }
</script>