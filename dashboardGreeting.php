<?php

/*

Plugin Name: DashBoard Greeting
Description: Giver dig en tidbestemt greeting

*/

class DashBoardGreeting {

    function __construct()
    {
     add_action('wp_dashboard_setup', array($this,'dashBoardGreeting'));   
    }
 
    function dashBoardGreeting() {
        wp_add_dashboard_widget(
            'dashBoardGreeting',
            'Dashboard Greeting',
            'dash_callback'
        );

            // DASHBOARD WIDGET
            function dash_callback() {

                //TJEKKER TIDEN PÅ DAGEN
                $hour = date('H');
                if ($hour >= 20) {
                    $greeting = "<p class='greeting'>Good Night</p> <br> CATIMAGE";
                } 
                elseif ($hour > 17) {
                    $greeting = "Good Evening";
                } 
                elseif ($hour > 11) {
                    $greeting = 'Good Afternoon <br><br>
                <iframe width="100%" height="315" src="https://www.youtube.com/embed/O5APc0z49wg" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                } 
                elseif ($hour < 12) {
                    $greeting = 'Good Morning <br><br>
                <iframe width="100%" height="315" src="https://www.youtube.com/embed/O5APc0z49wg" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                }
                echo $greeting;

                // OUTPUTTER EN RANDOM CAT FACT, fordi.
                            $data = file_get_contents(esc_url('https://catfact.ninja/fact'));
                            $cat = json_decode($data);
                            echo "<style type='text/css'>#cat {margin: 0; color: blue; font-size: 16px;}</style><p id='cat'>Random Cat Fact:</p><p>$cat->fact</p>";

            }
    }
}

$obj = new DashBoardGreeting();