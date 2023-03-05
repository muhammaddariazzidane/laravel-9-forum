<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forum-ngebull</title>

    @notifyCss
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }

        #menu-toggle:checked+#menu {
            display: block;
        }
    </style>
</head>

<body class=" scrollbar-hide bg-black">
    <div class=" ">

        @include('components.header.navbar')

        <div class="max-w-3xl mx-auto px-6 min-h-screen h-full">
            @yield('content')
        </div>

    </div>
    @include('components.footer')
    {{-- @include('components.button.to-top') --}}
    <x:notify-messages />
    @notifyJs
    <script>
        function handlePrev() {
            const imgPreview = document.querySelector('.img-preview')
            const inputImg = document.querySelector('#input-img')
            const wrapPrevImg = document.querySelector('#wrapPrevImg')

            const fileSampul = new FileReader()

            fileSampul.readAsDataURL(inputImg.files[0])

            fileSampul.onload = function(e) {
                wrapPrevImg.classList.remove('hidden')
                imgPreview.src = e.target.result
            }
        }
    </script>
</body>

</html>
