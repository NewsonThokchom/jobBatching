<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Job Batching</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <section class=" flex justify-center my-8">

        <div class="border my-5 p-5 rounded">
            <h3 class=" text-lg font-bold text-indigo-500 mb-4">Job Batching</h3>

            <form action="/store" method="POST" enctype="multipart/form-data">`
                @csrf
                <input type="file" name="mycsv" id="mycsv">
                <input
                    class="bg-indigo-500 text-white text-sm px-3 py-1 rounded hover:bg-indigo-700 focus:outline-none focus:border-transparent cursor-pointer border-tranparent"
                    type="submit" value="Upload">
            </form>
        </div>

    </section>

</body>

</html>
