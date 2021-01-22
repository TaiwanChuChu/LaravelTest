<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/app.css" />
    <title>Larave + Vue</title>
</head>
<body>
    <div id="app">
        {{-- <example-component :footer="'{{ $footer }}'" v-if="'{{ $footer }}' != ''" :author="'{{ $author }}'"></example-component> --}}
        <activity-component></activity-component>
    </div>
    <script src="js/app.js"></script>   
</body>
</html>
