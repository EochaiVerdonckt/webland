<?php


function getDates()
{

    $dbname = "mobile_express_";
    $usernameDb = "mobile_express_";
    $passwordDb = "E9EGWx3M";
    $hostname = "mobile-express.be.mysql";

// Create connection
    $conn = mysqli_connect($hostname, $usernameDb, $passwordDb, $dbname);

// Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM afspraakSlot WHERE begin >= CURDATE()";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $rij = array();
        while($row = mysqli_fetch_assoc($result)) {
            array_push ( $rij ,$row['begin'] );
        }

        return $rij;
    }
    mysqli_close($conn);
    $conn->close();
}

$rij=getDates();

$tijd="0 min.";
$behandeling = $_POST['behandeling'];
if($_POST['tijd']==1)
{
    $tijd="30 min.";
}
if($_POST['tijd']==2)
{
    $tijd="120 min.";
}

if($_POST['tijd']==3)
{
    $tijd="60 min.";
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8' />
    <link href='../fullcalendar.css' rel='stylesheet' />
    <link href='../fullcalendar.print.css' rel='stylesheet' media='print' />
    <script src="date.js"></script>
    <script src='../lib/moment.min.js'></script>
    <script src='../lib/jquery.min.js'></script>
    <script src='../fullcalendar.min.js'></script>
    <script src='../locale/nl.js'></script>
    <script>

        $(document).ready(function() {

            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();


            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                defaultDate: '2016-09-12',
                navLinks: true, // can click day/week names to navigate views

                weekNumbers: true,
                weekNumbersWithinDays: true,
                weekNumberCalculation: 'ISO',

                editable: true,
                eventLimit: true, // allow "more" link when too many events

                events: [
                ]
            });




            var rij = <?php echo json_encode($rij); ?>;
            $.each( rij, function( key, value ) {
                var date= new Date(value);
                rij[key]=date;
            });





            // adding a every monday and wednesday events:
            $('#calendar').fullCalendar( 'addEventSource',
                function(start, end, status, callback) {
                    // When requested, dynamically generate virtual
                    // events for every monday and wednesday.
                    var events = [];

                    var convertDate=function convertDate(inputFormat) {
                        function pad(s) { return (s < 10) ? '0' + s : s; }
                        var d = new Date(inputFormat);
                        return [pad(d.getDate()), pad(d.getMonth()+1), d.getFullYear()].join('/');
                    };


                    for (loop = start._d.getTime();
                         loop <= end._d.getTime();
                         loop = loop + (24 * 60 * 60 * 1000)) {
                        var url = 'http://mobile-express.be/balance/agenda/conform.php?behandeling=';
                        url= url+$('#behandeling').text();
                        url = url+"&datum=";


                        //10 u.
                        var test_date = new Date(loop);
                        test_date.setHours(10);
                        var noAdd= false;
                        $.each( rij, function( key, value ) {
                            if(test_date.getTime()===value.getTime())
                            {
                                noAdd=true;
                                return false;
                            }

                        });

                        if(!noAdd)
                        {
                            events.push({
                                title: 'Beschikbaar',
                                url: url+convertDate(test_date)+"&uur="+test_date.getHours(),
                                start: test_date
                            });
                        }




                        //12u
                        var test_date2 = new Date(loop);
                        test_date2.setHours(12);

                        var noAdd= false;
                        $.each( rij, function( key, value ) {
                            if(test_date2.getTime()===value.getTime())
                            {
                                noAdd=true;
                                return false;
                            }

                        });

                        if(!noAdd)
                        {
                            events.push({
                                title: 'Beschikbaar',
                                url: url+convertDate(test_date)+"&uur="+test_date2.getHours(),
                                start: test_date2
                            });
                        }

                        //14u
                        var test_date3 = new Date(loop);
                        test_date3.setHours(14);
                        var noAdd= false;
                        $.each( rij, function( key, value ) {
                            if(test_date3.getTime()===value.getTime())
                            {
                                noAdd=true;
                                return false;
                            }

                        });

                        if(!noAdd)
                        {
                            events.push({
                                title: 'Beschikbaar',
                                url: url+convertDate(test_date3)+"&uur="+test_date3.getHours(),
                                start: test_date3
                            });
                        }

                        //16u
                        var test_date4 = new Date(loop);
                        test_date4.setTime(test_date2.getTime() + (4*60*60*1000));
                        test_date4.setHours(16);
                        var noAdd= false;
                        $.each( rij, function( key, value ) {
                            if(test_date4.getTime()===value.getTime())
                            {
                                noAdd=true;
                                return false;
                            }

                        });

                        if(!noAdd)
                        {
                            events.push({
                                title: 'Beschikbaar',
                                url: url+convertDate(test_date4)+"&uur="+test_date4.getHours(),
                                start: test_date4
                            });
                        }

                        //18u
                        var test_date5 = new Date(loop);

                        test_date5.setHours(18);
                        var noAdd= false;
                        $.each( rij, function( key, value ) {
                            if(test_date5.getTime()===value.getTime())
                            {
                                noAdd=true;
                                return false;
                            }

                        });

                        if(!noAdd)
                        {
                            events.push({
                                title: 'Beschikbaar',
                                url: url+convertDate(test_date5)+"&uur="+test_date5.getHours(),
                                start: test_date5
                            });
                        }

                        //20u
                        var test_date6 = new Date(loop);
                        test_date6.setHours(20);

                        var noAdd= false;
                        $.each( rij, function( key, value ) {
                            if(test_date6.getTime()===value.getTime())
                            {
                                noAdd=true;
                                return false;
                            }

                        });

                        if(!noAdd)
                        {
                            events.push({
                                title: 'Beschikbaar',
                                url: url+convertDate(test_date6)+"&uur="+test_date6.getHours(),
                                start: test_date6
                            });
                        }




                        /*
                        if (test_date.is().sunday()) {
                            // we're in Wednesday, create the Wednesday event
                            events.push({
                                title: 'Beschkbaar',
                                start: test_date
                            });
                            events.push({
                                title: 'Beschikbaar',
                                start: test_date2
                            });
                        }
                        */
                    } // for loop

                    // return events generated
                    callback( events );
                });
        });

    </script>
    <style>

        body {
            margin: 40px 10px;
            padding: 0;
            font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
            font-size: 14px;
        }

        #calendar {
            max-width: 900px;
            margin: 0 auto;
        }

    </style>
</head>
<body>

<h1 style="text-align: center">Je hebt gekozen voor <?php echo $behandeling; ?> van <?php echo $tijd; ?></h1>
<p id="behandeling" style="display:none;"><?php echo $behandeling; ?></p>
<div id='calendar'></div>

</body>
</html>

