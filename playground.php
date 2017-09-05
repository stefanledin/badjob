<?php

/**
 * 1. Man ska kunna lägga till en tidsredovisning.
 * 2. Den har en starttid (standard = nu) och kan ha en sluttid.
 * 3. Den har en "etikett" som beskriver vad man gjort.
 * 4. Den kan tillhöra ett projekt.
 * 5. Den kan tillhöra en kund.
 * 6. Man kan skriva upp en minnesanteckning.
 * 7. Man kan skriva upp en att göra-lista.
 * 8. Man kan ställa in hur mycket tid man ska lägga på/dra i från.
 * 9. Man kan ställa in hur lång arbetsdagen är (8h standard)
 * 10. Interntid?
 * 11. Skicka en push-notis för att kolla om man fortfarande jobbar.
 * 12. Synkar mellan olika enheter automatiskt.
 */
new Entry(array(
    'start' => '2017-10-10 07:00',
    'end' => '2017-10-10 08:00',
    'working_with' => 'Rally Sweden'
));

new TimeEntry();
