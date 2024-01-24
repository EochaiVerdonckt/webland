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

    $sql = "SELECT begin, eind FROM afspraakSlot_gesprek WHERE begin >= CURDATE()";

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

    $sql = "SELECT * FROM afspraakSlot_gesprek WHERE begin >= CURDATE()";

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

function getDates3()
{
    
    //BETWEEN '2013-03-26 00:00:01' AND '2013-03-26 23:59:59'
    
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

    $sql = "SELECT * FROM afspraakSlot_gesprek WHERE begin >= CURDATE()";

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


$tijd="0 min.";
$behandeling = "theraphie";
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
                    right: 'month,agendaWeek,agendaDay'
                },
                
                eventAfterRender: function (event, element, view) {
                  
                            if (event.title=="Bezet") {
                                //event.color = "#FFB347"; //Em andamento
                                element.css('background-color', '#FFB347');
                            }
                            
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

            var rij2 = <?php echo json_encode($rij2); ?>;

            $.each( rij, function( key, value ) {
                var date= new Date(value);
                rij[key]=date;
            });

            $.each( rij2, function( key, value ) {
                value.begin = new Date(value.begin);
                value.eind = new Date(value.eind);
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
                    function addMinutes(date, minutes) {
                        return new Date(date.getTime() + minutes*60000);
                    }


                    for (loop = start._d.getTime();
                         loop <= end._d.getTime();
                         loop = loop + (24 * 60 * 60 * 1000)) {
                        var url = 'http://mobile-express.be/gesprek/agenda/conformHoliday.php?behandeling=';
                        url= url+$('#behandeling').text();
                        url = url+"&datum=";


                        //10 u.
                        var test_date = new Date(loop);
                        test_date.setHours(06);
                        var noAdd= false;
                        var bezet=false;
                        $.each( rij, function( key, value ) {
                            if(test_date.getTime()===value.getTime())
                            {
                                noAdd=true;
                                bezet=true;
                                return false;
                            }
                            if(test_date.getDate()===value.getDate() && test_date.getMonth()===value.getMonth() && test_date.getYear()===value.getYear())
                            {
                                console.log(value);
                                console.log(test_date);
                                noAdd=true;
                                bezet=true;
                                return false;
                            }                 

                        });

                        if(!noAdd)
                        {
                            $.each( rij2, function( key, value ) {
                                if(test_date.getTime()>value.begin.getTime()&&test_date.getTime()<value.eind.getTime())
                                {
                                    noAdd=true;
                                    bezet=true;
                                    return false;
                                }
                            });
                        }
                        
                        
                         if (test_date.is().sunday() || test_date.is().saturday() ) {
                             noAdd=true;
                             bezet=false;
                        }


                        if(!noAdd)
                        {
                            var test_end = new Date(test_date.getTime());
                            test_end=addMinutes(test_end, 1060);

                            events.push({
                                title: 'Beschikbaar',
                                url: url+convertDate(test_date)+"&uur="+test_date.getHours(),
                                start: test_date,
                                end: test_end
                            });
                        }
            
            
                        if(bezet)
                        {
                            var test_end = new Date(test_date.getTime());
                            test_end=addMinutes(test_end, 1060);

                            events.push({
                                title: 'Bezet',
                                start: test_date,
                                end: test_end
                            });
                        }
                        

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

<h1 style="text-align: center">Neem een dag vrij</h1>
<p id="behandeling" style="display:none;"><?php echo $behandeling; ?></p>
<div id='calendar'></div>

</body>
</html>

