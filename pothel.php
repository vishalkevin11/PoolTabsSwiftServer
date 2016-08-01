<?php

$ddd ="SELECT distinct routeId , 3956 * 2 * 
          ASIN(SQRT( POWER(SIN((12.87 - latitude)*pi()/180/2),2)
          +COS(12.87*pi()/180 )*COS(latitude*pi()/180)
          *POWER(SIN((77.93-longitude)*pi()/180/2),2))) as distanceA

         

from LatLongs
where longitude between (77.93-2/cos(radians(12.87))*69) 
          and (77.93+2/cos(radians(12.87))*69) 
          and latitude between (12.87-(2/69)) 
          and (12.87+(2/69)) 
          having distanceA < 2"
?>