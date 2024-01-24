<?php



function getDates2()
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

$rij2 =getDates2();


$tijd="15 min.";
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

            var rij2 = <?php echo json_encode($rij2); ?>;

            $.each( rij, function( key, value ) {
                var date= new Date(value);
                rij[key]=date;
            });

            $.each( rij2, function( key, value ) {
                value.begin = new Date(value.begin);
                value.eind = new Date(value.eind);
            });


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
                    test_end=addMinutes(test_end, 15);

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


                    for (loop = start._d.getTime();
                         loop <= end._d.getTime();
                         loop = loop + (24 * 60 * 60 * 1000)) {
                        var url = 'http://mobile-express.be/balance/agenda/conform30.php?behandeling=';
                        url= url+$('#behandeling').text();
                        url = url+"&datum=";


                        //10 u.
                        var test_date = new Date(loop);
                        test_date.setHours(10);
                        voegToe(rij,rij2,test_date,events,url);

                        //10.30
                        var test_dateH = new Date(loop);
                        test_dateH.setHours(10);
                        test_dateH.setMinutes(15);
                        voegToe(rij,rij2,test_dateH,events,url);

                        //11 u.
                        var test_dateb = new Date(loop);
                        test_dateb.setHours(10);
                         test_dateb.setMinutes(30);
                        voegToe(rij,rij2,test_dateb,events,url);
                         //11 u.
                        var test_dateb = new Date(loop);
                        test_dateb.setHours(10);
                         test_dateb.setMinutes(45);
                        voegToe(rij,rij2,test_dateb,events,url);
                        //11.30 u.
                        var test_datebH = new Date(loop);
                        test_datebH.setHours(11);
                        voegToe(rij,rij2,test_datebH,events,url);

                        //12u
                        var test_date2 = new Date(loop);
                        test_date2.setHours(11);
                        test_date2.setMinutes(15);
                        voegToe(rij,rij2,test_date2,events,url);
                        //12.30 u.
                        var test_date2H = new Date(loop);
                        test_date2H.setHours(11);
                        test_date2H.setMinutes(30);
                        voegToe(rij,rij2,test_date2H,events,url);
                        var test_date2H = new Date(loop);
                        test_date2H.setHours(11);
                        test_date2H.setMinutes(45);
                        voegToe(rij,rij2,test_date2H,events,url);

                        //13u
                        var test_date2b = new Date(loop);
                        test_date2b.setHours(12);
                        voegToe(rij,rij2,test_date2b,events,url);
                        //13.30 u.
                        var test_date2bH = new Date(loop);
                        test_date2bH.setHours(12);
                        test_date2bH.setMinutes(15);
                        voegToe(rij,rij2,test_date2bH,events,url);

                        //14u
                        var test_date3 = new Date(loop);
                        test_date3.setHours(12);
                         test_date3.setMinutes(30);
                        voegToe(rij,rij2,test_date3,events,url);
                        //14u
                        var test_date3 = new Date(loop);
                        test_date3.setHours(12);
                         test_date3.setMinutes(45);
                        voegToe(rij,rij2,test_date3,events,url);
                        //14.30 u.
                        var test_date3H = new Date(loop);
                        test_date3H.setHours(13);
                        voegToe(rij,rij2,test_date3H,events,url);

                        //15u
                        var test_date3b = new Date(loop);
                        test_date3b.setHours(13);
                         test_date3b.setMinutes(15);
                        voegToe(rij,rij2,test_date3b,events,url);
                        //15.30 u.
                        var test_date3bH = new Date(loop);
                        test_date3bH.setHours(13);
                        test_date3bH.setMinutes(30);
                        voegToe(rij,rij2,test_date3bH,events,url);
                          //15.30 u.
                        var test_date3bH = new Date(loop);
                        test_date3bH.setHours(13);
                        test_date3bH.setMinutes(45);
                        voegToe(rij,rij2,test_date3bH,events,url);

                        //16u
                        var test_date4 = new Date(loop);
                        test_date4.setHours(14);
                        voegToe(rij,rij2,test_date4,events,url);
                        //16.30 u.
                        var test_date4H = new Date(loop);
                        test_date4H.setHours(14);
                        test_date4H.setMinutes(15);
                        voegToe(rij,rij2,test_date4H,events,url);
                         //16.30 u.
                        var test_date4H = new Date(loop);
                        test_date4H.setHours(14);
                        test_date4H.setMinutes(30);
                        voegToe(rij,rij2,test_date4H,events,url);
                        var test_date4H = new Date(loop);
                        test_date4H.setHours(14);
                        test_date4H.setMinutes(45);
                        voegToe(rij,rij2,test_date4H,events,url);

                        //17u
                        var test_date4b = new Date(loop);
                        test_date4b.setHours(15);
                        voegToe(rij,rij2,test_date4b,events,url);

                        //17.30 u.
                        var test_date4bH = new Date(loop);
                        test_date4bH.setHours(15);
                        test_date4bH.setMinutes(15);
                        voegToe(rij,rij2,test_date4bH,events,url);
                        //18u
                        var test_date5 = new Date(loop);
                        test_date5.setHours(15);
                        test_date5.setMinutes(30);
                        voegToe(rij,rij2,test_date5,events,url);
                         var test_date5 = new Date(loop);
                        test_date5.setHours(15);
                        test_date5.setMinutes(45);
                        voegToe(rij,rij2,test_date5,events,url);
                        //18.30 u.
                        var test_date5H = new Date(loop);
                        test_date5H.setHours(16);
                        voegToe(rij,rij2,test_date5H,events,url);
                        //19u
                        var test_date5b = new Date(loop);
                        test_date5b.setHours(16);
                        test_date5b.setMinutes(15);
                        voegToe(rij,rij2,test_date5b,events,url);
                        //19.30 u.
                        var test_date5bH = new Date(loop);
                        test_date5bH.setHours(16);
                        test_date5bH.setMinutes(30);
                        voegToe(rij,rij2,test_date5bH,events,url);
                         var test_date5bH = new Date(loop);
                        test_date5bH.setHours(16);
                        test_date5bH.setMinutes(45);
                        voegToe(rij,rij2,test_date5bH,events,url);
                        //20u
                        var test_date6 = new Date(loop);
                        test_date6.setHours(17);
                        voegToe(rij,rij2,test_date6,events,url);
                             var test_date6 = new Date(loop);
                        test_date6.setHours(17);
                        test_date6.setMinutes(15);
                        voegToe(rij,rij2,test_date6,events,url);
                          var test_date6 = new Date(loop);
                        test_date6.setHours(17);
                        test_date6.setMinutes(30);
                        voegToe(rij,rij2,test_date6,events,url);
                        var test_date6 = new Date(loop);
                        test_date6.setHours(17);
                        test_date6.setMinutes(45);
                        voegToe(rij,rij2,test_date6,events,url);

                                                var test_date6 = new Date(loop);
                        test_date6.setHours(18);
                        voegToe(rij,rij2,test_date6,events,url);
                          var test_date6 = new Date(loop);
                        test_date6.setHours(18);
                        test_date6.setMinutes(15);
                        voegToe(rij,rij2,test_date6,events,url);  
                          var test_date6 = new Date(loop);
                        test_date6.setHours(18);
                        test_date6.setMinutes(30);
                        voegToe(rij,rij2,test_date6,events,url);  
                        var test_date6 = new Date(loop);
                        test_date6.setHours(18);
                        test_date6.setMinutes(45);
                        voegToe(rij,rij2,test_date6,events,url);  

                                                var test_date6 = new Date(loop);
                        test_date6.setHours(19);
                        voegToe(rij,rij2,test_date6,events,url);
                          var test_date6 = new Date(loop);
                        test_date6.setHours(19);
                        test_date6.setMinutes(15);
                        voegToe(rij,rij2,test_date6,events,url);
                          var test_date6 = new Date(loop);
                        test_date6.setHours(19);
                        test_date6.setMinutes(30);
                        voegToe(rij,rij2,test_date6,events,url); 
                         var test_date6 = new Date(loop);
                        test_date6.setHours(19);
                        test_date6.setMinutes(45);
                        voegToe(rij,rij2,test_date6,events,url);    
                                                var test_date6 = new Date(loop);
                        test_date6.setHours(20);
                        voegToe(rij,rij2,test_date6,events,url);
                          var test_date6 = new Date(loop);
                        test_date6.setHours(20);
                        test_date6.setMinutes(15);
                        voegToe(rij,rij2,test_date6,events,url);
                        //20.30 u.
                        var test_date6H = new Date(loop);
                        test_date6H.setHours(20);
                        test_date6H.setMinutes(30);
                        voegToe(rij,rij2,test_date6H,events,url);
                        var test_date6H = new Date(loop);
                        test_date6H.setHours(20);
                        test_date6H.setMinutes(45);
                        voegToe(rij,rij2,test_date6H,events,url);
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

