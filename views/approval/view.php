<?php

require_once "../../database/connection.php";

$requestID = $_GET["request_id"];

$query ="SELECT * FROM request 
INNER JOIN user ON request.USER_ID = user.USER_ID
INNER JOIN resource ON request.RESOURCE_ID = resource.ID
INNER JOIN time_slot ON request.TIME_SLOT_ID = time_slot.ID
INNER JOIN events ON request.EVENT_ID = events.ID
WHERE REQUEST_ID = '$requestID'";


$result = $conn->query($query);

if($result->num_rows>0){
    $row = $result->fetch_assoc();
    $resource = $row["RESOURCE_NAME"];
    $start = $row["START_TIME"];
    $end=$row["END_TIME"];
    $date = $row["REQUEST_DATE"];
    $event = $row["EVENT_NAME"];
    $approved = $row["APPROVED"]==1?"Yes":"No";
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.0/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../output.css">
    <link rel="stylesheet" href="../../assets/lib/simple-notify.min.css" />
    <script src="../../assets/lib/simple-notify.min.js"></script>

</head>

<body>
    <div class="px-6 py-6 lg:px-8">
        <form id="approveForm" class="space-y-6" action="#">
            <div class="grid w-3/4 xl:w-1/4 " >
                <form action="">
                    <div class="space-y-6">
                        <div>
                            <label for="password"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Request ID</label>
                            <input type="text" name="conduct_by" id="conduct_by" placeholder="IEEE" disabled
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                value=<?php echo "'".$requestID."'" ?> >
                                
                        </div>
                        <div>
                            <label for="password"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Resource Name</label>
                            <input type="text" name="conduct_by" id="conduct_by" placeholder="IEEE" disabled
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                value=<?php echo "'".$resource."'" ?> >
                                
                        </div>
                        <div>
                            <label for="password"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Start Time</label>
                            <input type="text" name="conduct_by" id="conduct_by" placeholder="IEEE" disabled
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                value=<?php echo "'".$start.":00'" ?> >
                                
                        </div>
                        <div>
                            <label for="password"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">End Time</label>
                            <input type="text" name="conduct_by" id="conduct_by" placeholder="IEEE" disabled
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                value=<?php echo "'".$end.":00'" ?> >
                                
                        </div>
                        <div>
                            <label for="password"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date</label>
                            <input type="text" name="conduct_by" id="conduct_by" placeholder="IEEE" disabled
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                value=<?php echo "'".$date."'" ?> >
                        </div>
                        <div>
                            <label for="password"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Event Name</label>
                            <input type="text" name="conduct_by" id="conduct_by" placeholder="IEEE" disabled
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                value=<?php echo "'".$event."'" ?> >
                                
                        </div>
                        <div>
                            <label for="password"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Approved</label>
                            <input type="text" name="conduct_by" id="conduct_by" placeholder="IEEE" disabled
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                value=<?php echo "'".$approved."'" ?> >
                                
                        </div>
                    </div>

                </form>




            </div>
    </div>

    </form>
    </div>
</body>

</html>