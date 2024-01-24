<?php



function getDates2()
{

    $xml=simplexml_load_file("../../../db.xml") or die("Error: Cannot create object");
    $usernameDb = $xml->usernameDb;
    $passwordDb = $xml->passwordDb;
    $hostname = $xml->hostname;
    $dbname = $xml->dbname;

// Create connection
    $conn = mysqli_connect($hostname, $usernameDb, $passwordDb, $dbname);

// Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT begin, eind FROM afspraakSlot WHERE begin >= CURDATE()";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $rij = array();
        while($row = mysqli_fetch_assoc($result)) {
            array_push ( $rij ,$row);
        }

        return $rij;
    }
    mysqli_close($conn);
    $conn->close();
}

function getDates()
{
    $xml=simplexml_load_file("../../../db.xml") or die("Error: Cannot create object");
    $usernameDb = $xml->usernameDb;
    $passwordDb = $xml->passwordDb;
    $hostname = $xml->hostname;
    $dbname = $xml->dbname;

// Create connection
    $conn = mysqli_connect($hostname, $usernameDb, $passwordDb, $dbname);

// Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM afspraakSlot_gesprek WHERE begin >= CURDATE()";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $rij = array();
        while($row = mysqli_fetch_assoc($result)) {
            array_push ( $rij ,$row);
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
   var today = new Date();
var dd = today.getDate();
var mm = today.getMonth()+1; //January is 0!
var yyyy = today.getFullYear();

if(dd<10) {
    dd='0'+dd
} 

if(mm<10) {
    mm='0'+mm
} 

today = yyyy+'-'+mm+'-'+dd;


            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay,listWeek'
                },
                defaultDate: today,
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
                value.begin = new Date(value.begin);
                value.eind = new Date(value.eind);
            });

            console.log(rij);


            function check(rij, test_date,noAdd)
            {
                $.each( rij, function( key, value ) {
                    if(test_date.getTime()===value.getTime())
                    {
                        noAdd=true;
                        return false;
                    }

                });
                return noAdd;
            }

            function check2(noAdd,rij2,test_date)
            {
                if(!noAdd)
                {
                    $.each( rij2, function( key, value ) {
                        if(test_date.getTime()>value.begin.getTime()&&test_date.getTime()<value.eind.getTime())
                        {
                            noAdd=true;
                            return false;
                        }
                    });
                }
                return noAdd;
            }

            function addMinutes(date, minutes) {
                return new Date(date.getTime() + minutes*60000);
            }

            var convertDate=function convertDate(inputFormat) {
                function pad(s) { return (s < 10) ? '0' + s : s; }
                var d = new Date(inputFormat);
                return [pad(d.getDate()), pad(d.getMonth()+1), d.getFullYear()].join('/');
            };

            function voegToe(rij,rij2,test_date,events,url)
            {
                var noAdd= false;

                noAdd=check(rij, test_date,noAdd);
                noAdd=check2(noAdd,rij2,test_date);

                if(!noAdd)
                {
                    var test_end = new Date(test_date.getTime());
                    test_end=addMinutes(test_end, 30);

                    events.push({
                        title: 'Beschikbaar',
                        url: url+convertDate(test_date)+"&uur="+test_date.getHours()+'&min='+test_date.getMinutes(),
                        start: test_date,
                        end: test_end
                    });
                }
            }



            // adding a every monday and wednesday events:
            $('#calendar').fullCalendar( 'addEventSource',
                function(start, end, status, callback) {
                    // When requested, dynamically generate virtual
                    // events for every monday and wednesday.
                    var events = [];

                    $.each( rij, function( key, value ) {
                        events.push({
                            title: value.behandeling,
                            start: value.begin,
                            end: value.eind
                        });
                    });

                    /*


                     */

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

<h1 style="text-align: center">Bekijk hier je afspraken.</h1>
<p id="behandeling" style="display:none;"><?php echo $behandeling; ?></p>
<div id='calendar'></div>

</body>
</html>

