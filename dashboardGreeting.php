<?php

/*

Plugin Name: DashBoard Greeting
Description: Giver dig en tidbestemt greeting samt katte facts
Version: 2.1

*/

defined( 'ABSPATH' ) or die( 'Intet at se her' );

class DashBoardGreeting {

    function __construct()
    {
     add_action('wp_dashboard_setup', array($this,'dashBoardGreeting')); 
     add_action('init', array ($this, 'StyleGreeting'));  
    }

    // STYLESHEET FUNCTION
    function StyleGreeting() {
        $search = plugins_url ('/style.css', __FILE__);
        wp_enqueue_style('StyleGreeting', $search, '');
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
                    $greeting = '<p class="kattekasse">Good Night</p> <br><br>
                    <iframe width="100%" height="315" src="https://www.youtube.com/embed/wWxmQOkMGfI" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                } 
                elseif ($hour > 17) {
                    $greeting = 'Good Evening <br><br>
                    <iframe width="100%" height="315" src="https://www.youtube.com/embed/hzYOA4-xNaA" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                } 
                elseif ($hour > 11) {
                    $greeting = 'Good Afternoon <br><br>
                <iframe width="100%" height="315" src="https://www.youtube.com/embed/wu1UXCdyNo0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                } 
                elseif ($hour < 12) {
                    $greeting = '<p class="kattekasse">Good Morning</p> <br><br>
                <iframe width="100%" height="315" src="https://www.youtube.com/embed/O5APc0z49wg" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                }
                echo $greeting;


               

                // OUTPUTTER EN RANDOM CAT FACT, fordi.
                            $data = file_get_contents(esc_url('https://catfact.ninja/fact'));
                            $cat = json_decode($data);

                            // tjekker om htmlspecialchars virker
                            /* $cat->fact = "<script>window.location = 'http://wwww.google.com';</script>"; */

                            echo "<p class='katfacts'>Random Cat Fact:</p><p class='katText'>" . htmlspecialchars($cat->fact) . "</p>";

            }
    }
}

$obj = new DashBoardGreeting();