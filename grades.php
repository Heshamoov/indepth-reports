<?php
session_start();
if (!isset($_SESSION['login'])) {
    $_SESSION['notloggedin'] = 1;
    header('Location: index.php');
} else {
    include('Header.php');
    ?>

    <link rel="stylesheet" href="styles/grades.css">

    <title>Traffic Stop Benchmark</title>

    </head>


    <!-- <script type="text/javascript">
        $( document ).ready(function() {
            document.getElementById('pp').click();
    });
    </script> -->


    <script type="text/javascript">
        $(function () {
            $('#subjectD').multiselect({includeSelectAllOption: false});
            $('#exam').multiselect({includeSelectAllOption: false});
            $('#trend').multiselect({includeSelectAllOption: false});

            var select = document.getElementById('subjectD');
            var httpsubjects = new XMLHttpRequest();
            httpsubjects.onreadystatechange = function () {
                if (this.readyState === 4) {
                    var str = this.responseText;
                    subjectsArray = str.split("\t");
                }
            };

            httpsubjects.open("GET", "sqldb/subjects.php", false);
            httpsubjects.send();

            $('#subjectD').multiselect('destroy');

            delete subjectsArray[subjectsArray.length - 1];

            select.add(new Option("Subject"));

            for (var i in subjectsArray)
                select.add(new Option(subjectsArray[i]));

            $(function () {
                $('#subjectD').multiselect({
                    includeSelectAllOption: true
                });
            });

// *******************   Exams ******************
            var exam = document.getElementById('exam');

            var httpTerms = new XMLHttpRequest();
            httpTerms.onreadystatechange = function () {
                if (this.readyState === 4) {
                    var str = this.responseText;
                    termsArray = str.split("\t");
                }
            };

            httpTerms.open("GET", "sqldb/terms.php", false);
            httpTerms.send();

            $('#exam').multiselect('destroy');

            delete termsArray[termsArray.length - 1];

            for (var i in termsArray)
                exam.add(new Option(termsArray[i]));

            $(function () {
                $('#exam').multiselect({
                    includeSelectAllOption: false
                });
            });

        });
    </script>


    <script type="text/javascript">
        function search() {
            let trend = $("#trend option:selected").text();

            let subject = $("#subjectD option:selected").text();
            if (subject == "Subject")
                alert("Select a Subject");
            else {
                let exam = $("#exam option:selected").text();
                var httpsearch = new XMLHttpRequest();
                httpsearch.onreadystatechange = function () {
                    if (this.readyState === 4) {
                        document.getElementById("result").innerHTML = this.responseText;
                    }
                };

                httpsearch.open("POST", "sqldb/trafficSearch.php?subject=" + subject + "&exam=" + exam + "&trend=" + trend, false);
                httpsearch.send();

                document.getElementById('SubjectName').innerHTML = subject;
                document.getElementById('ExamName').innerHTML = exam;
            }
        }
    </script>

    <body>
    <div class="w3-responsive">
        <?php include('navbar.php'); ?>
        <script>document.getElementById("navAdvanced").style.backgroundColor = '#009688';</script>
    </div>

    <!-- <label id="out"></label>  -->

    <?php include('inc/benchmarks.php') ?>

    <th>
        <select id="subjectD" onchange="search()"></select>
    </th>
    <th>
        <select class="dropdown" id="exam" onchange="search()"></select>
    </th>
    <th>
        <select class="dropdown" id="trend" onchange="search()">
            <option>Trend</option>
            <option>Details</option>
        </select>
    </th>
    <th>
        <button id='pp' class='w3-button w3-ripple w3-hover-green w3-round-xxlarge fa fa-print w3-xlarge'
                onclick="printJS({
                                documentTitle: 'Traffic Stop Benchmark - Al Sanawbar School',
                                printable: 'divprint',
                                type: 'html',
                                showModal:true,
                                ignoreElements: ['pp'],
                                // targetStyles: ['*']
                                css: 'styles/gradesPDF.css'
                                })">
        </button>
    </th>
    </table>
    </div>


    <div id="divprint">
        <br>
        <table id="PageTitle">
            <tr>
                <th id="SchoolLogoTH" colspan="2">
                    <img id="SchoolLogo" src="images/sanawbar.jpg">
                </th>
            </tr>
            <tr>
                <th id="SchoolName" colspan="2">
                    Al Sanawbar School
                </th>
            </tr>
        </table>
        <!-- ****************************************************************************************************** -->

        <table id="SchoolInfo" class="w3-card">       <!--Header Table-->
            <thead>
            <tr>
                <th class="w3-yellow yellowcolor">School Type:</th>
                <th colspan="3">
                    <input type='text' class='JText bigtext' value='American School' style='width: 100%; 
                                                  box-sizing: border-box;
                                                 -webkit-box-sizing:border-box;
                                                 -moz-box-sizing: border-box;
                                                 text-align: center;
                                                 border: none;'>
                </th>
            </tr>
            <tr>
                <th class="w3-yellow">School Name</th>
                <th>
                    <input type='text' class='JText bigtext' value='Al Sanawbar School' style='width: 100%; 
                                                  box-sizing: border-box;
                                                 -webkit-box-sizing:border-box;
                                                 -moz-box-sizing: border-box;
                                                 text-align: center;
                                                 border: none;'>
                </th>
                <th class="w3-yellow">ID</th>
                <th>
                    <input type='text' class='JText bigtext' value='9147' style='width: 100%; 
                                                  box-sizing: border-box;
                                                 -webkit-box-sizing:border-box;
                                                 -moz-box-sizing: border-box;
                                                 text-align: center;
                                                 border: none;'>
                </th>
            </tr>
            <tr>
                <th class="w3-yellow">Region</th>
                <th>
                    <input type='text' class='JText bigtext' value='Al Ain' style='width: 100%; 
                                                  box-sizing: border-box;
                                                 -webkit-box-sizing:border-box;
                                                 -moz-box-sizing: border-box;
                                                 text-align: center;
                                                 border: none;'>
                </th>
                <th class="w3-yellow">Curriculum</th>
                <th>
                    <input type='text' class='JText bigtext' value='American' style='width: 100%; 
                                                  box-sizing: border-box;
                                                 -webkit-box-sizing:border-box;
                                                 -moz-box-sizing: border-box;
                                                 text-align: center;
                                                 border: none;'>
                </th>
            </tr>
            </thead>
        </table>

        <!-- ****************************Subject Exam********************************** -->

        <br>
        <table id="SubjectExam" class="w3-card">
            <thead>
            <tr>
                <th class="HiddenCell"></th>

                <th class="w3-yellow bigtext" colspan="4">
                    Subject name
                </th>

                <th colspan="8" id="SubjectName" class="bigtext"></th>
            </tr>

            <tr>
                <th class="HiddenCell"></th>

                <th class="w3-yellow bigtext" colspan="4">Exam name</th>

                <th colspan="8" id="ExamName" class="bigtext"></th>

                <th class="w3-blue " rowspan="2" colspan="2">
                    attainment judgment
                </th>
            </tr>
            <tr>
                <th class="HiddenCell"></th>
                <th class="w3-yellow bigtext" colspan="4">2017</th>
                <th class="w3-yellow bigtext" colspan="4">2018</th>
                <th class="w3-yellow bigtext" colspan="4">2019</th>
            </tr>
            <tr>
                <td></td>
                <td>
                    Number of Students
                </td>
                <td class="w3-green">
                    % students achieving levels above Expectations
                </td>
                <td class="w3-yellow">
                    % students achieving levels minimum Expectaions
                </td>
                <td class="w3-red">
                    % students achieving levels below Expectaions
                </td>

                <!-- ******************************************** -->
                <td>
                    Number of Students
                </td>
                <td class="w3-green">
                    % students achieving levels above Expectations
                </td>
                <td class="w3-yellow">
                    % students achieving levels minimum Expectaions
                </td>
                <td class="w3-red">
                    % students achieving levels below Expectaions
                </td>

                <!-- ******************************************** -->
                <td>
                    Number of Students
                </td>
                <td class="w3-green">
                    % students achieving levels above Expectations
                </td>
                <td class="w3-yellow">
                    % students achieving levels minimum Expectaions
                </td>
                <td class="w3-red">
                    % students achieving levels below Expectaions
                </td>

                <td class="w3-blue">
                    Attainment benchmark judgment for the latest year
                </td>
                <td class="w3-blue">
                    Trend in attainment over time
                </td>
            </tr>
            </thead>

            <tbody id="result"></tbody>
        </table>

        <!--  <table id="attainment" class="w3-card">
             <tr>
                 <th class='w3-yellow'>Subject name</th>
                 <th colspan=3 id="cellSubject"></th>
             </tr>
             <tr>
                 <th class='w3-yellow'>Exam name</th>
                 <th colspan=2 id="cellExam"></th>
                 <th rowspan=2 class='w3-blue'>attainment judjment</th>
             </tr>
             <tr>
                 <th class='w3-yellow'>2017</th>
                 <th class='w3-yellow'>2018</th>
                 <th class='w3-yellow'>2019</th>
             </tr>
             <tr>
                 <th>
                     <select class="select1">
                         <option>Outstanding</option>
                         <option>Very Good</option>
                         <option>Good</option>
                         <option>Acceptable</option>
                         <option>Weak</option>
                     </select>
                 </th>
                 <th>
                     <select class="select1">
                         <option>Outstanding</option>
                         <option>Very Good</option>
                         <option>Good</option>
                         <option>Acceptable</option>
                         <option>Weak</option>
                     </select>
                 </th>
                 <th>
                     <select class="select1">
                         <option>Outstanding</option>
                         <option>Very Good</option>
                         <option>Good</option>
                         <option>Acceptable</option>
                         <option>Weak</option>
                     </select>
                 </th>
                 <th>
                     <select class="select1">
                         <option>Outstanding</option>
                         <option>Very Good</option>
                         <option>Good</option>
                         <option>Acceptable</option>
                         <option>Weak</option>
                     </select>
                 </th>
             </tr>
         </table>; -->

        <table id="InDepthDiv">
            <tr>
                <td id="InDepthTD" style="text-align: right;">Powered By <a href="https://www.indepth.ae">InDepth</a>
                </td>
            </tr>
        </table>

    </div>

    </body>
    </html>

<?php } 
