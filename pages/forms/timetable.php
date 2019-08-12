<?php
$con = new mysqli("localhost","root","","timetable");
// days of week array
$days = array( 
1 => 'Monday', 
2 => 'Tuesday', 
3 => 'Wednesday', 
4 => 'Thursday', 
5 => 'Friday', 
6 => 'Saturday', 
7 => 'Sunday' );

//Selecting all the hours from lectures
// $hours = select id, start_time from lectures;

// $timetable = select timetable.id, timetable.day, timetable.lecture_id, timetable.subject_id from timetable;



echo "<table>";
echo "<tr>";

echo '<td></td>'; // empty cell

foreach( $hours as $hh ) {

    echo "<td>";    
    echo $hh->start_time;
    echo "</td>";

}

echo "</tr>";

foreach( $hours as $hour ) {

    foreach( $days as $day => $day_name ) {

        echo "<tr>";
        echo '<td>', $day_name, '</td>'; // day of the week

        foreach( $timetable as $tt ) {

            echo "<td>";

            if( (int)$tt->day == $day and $tt->lecture_id == $hour->id ) {
                echo $tt->subject_id;
            }

            echo "</td>";
        }

        echo "</tr>";
    }
}
echo "</table>";

?>