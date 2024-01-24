<?php
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
                    right: 'month,agendaWeek,agendaDay,listWeek'
                },
                defaultDate: '2016-09-12',
                navLinks: true, // can click day/week names to navigate views

                weekNumbers: true,
                weekNumbersWithinDays: true,
                weekNumberCalculation: 'ISO',

                editable: true,
                eventLimit: true, // allow "more" link when too many events

                events: [
                    /*
                    {
                        title: 'All Day Event',
                        start: '2016-09-01'
                    },

                    {
                        title: 'Long Event',
                        start: '2016-09-07',
                        end: '2016-09-10'
                    },

                    {
                        id: 999,
                        title: 'Beschikbaar',
                        start: '2016-09-09T10:00:00'

                    },
                    {
                        id: 999,
                        title: 'Beschikbaar',
                        start: '2016-09-16T16:00:00'
                    }
                    /*
                    {
                        title: 'Conference',
                        start: '2016-09-11',
                        end: '2016-09-13'
                    },
                    {
                        title: 'Meeting',
                        start: '2016-09-12T10:30:00',
                        end: '2016-09-12T12:30:00'
                    },
                    {
                        title: 'Lunch',
                        start: '2016-09-12T12:00:00'
                    },
                    {
                        title: 'Meeting',
                        start: '2016-09-12T14:30:00'
                    },
                    {
                        title: 'Happy Hour',
                        start: '2016-09-12T17:30:00'
                    },
                    {
                        title: 'Dinner',
                        start: '2016-09-12T20:00:00'
                    },
                    {
                        title: 'Birthday Party',
                        start: '2016-09-13T07:00:00'
                    },
                    {
                        title: 'Click for Google',
                        url: 'http://google.com/',
                        start: '2016-09-28'
                    }
                    */
                ]
            });



            // adding a every monday and wednesday events:
            $('#calendar').fullCalendar( 'addEventSource',
                function(start, end, status, callback) {
                    // When requested, dynamically generate virtual
                    // events for every monday and wednesday.
                    var events = [];


                    for (loop = start._d.getTime();
                         loop <= end._d.getTime();
                         loop = loop + (24 * 60 * 60 * 1000)) {

                        //10 u.
                        var test_date = new Date(loop);
                        test_date.setTime(test_date.getTime() + (8*60*60*1000));

                        //12u
                        var test_date2 = new Date(loop);
                        test_date2.setTime(test_date2.getTime() + (10*60*60*1000));

                        //14u
                        var test_date3 = new Date(loop);
                        test_date3.setTime(test_date2.getTime() + (2*60*60*1000));

                        //16u
                        var test_date4 = new Date(loop);
                        test_date4.setTime(test_date2.getTime() + (4*60*60*1000));

                        //18u
                        var test_date5 = new Date(loop);
                        test_date5.setTime(test_date2.getTime() + (6*60*60*1000));

                        //20u
                        var test_date6 = new Date(loop);
                        test_date6.setTime(test_date2.getTime() + (8*60*60*1000));


                            // we're in Moday, create the event
                            events.push({
                                title: 'Beschikbaar',
                                start: test_date
                            });
                            events.push({
                                title: 'Beschikbaar',
                                start: test_date2
                            });
                            events.push({
                                title: 'Beschikbaar',
                                start: test_date3
                            });
                        events.push({
                            title: 'Beschikbaar',
                            start: test_date4
                        });
                        events.push({
                            title: 'Beschikbaar',
                            start: test_date5
                        });
                        events.push({
                            title: 'Beschikbaar',
                            start: test_date6
                        });

                        /*
                        if (test_date.is().tuesday()) {
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

                        if (test_date.is().wednesday()) {
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
                        if (test_date.is().thursday()) {
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
                        if (test_date.is().friday()) {
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
                        if (test_date.is().saturday()) {
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

<div id='calendar'></div>

</body>
</html>

