<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/output.css">
    
</head>
<body>
<?php include('view/header.php'); ?>    
    <div id="app"></div>

    <script src="https://unpkg.com/react@18/umd/react.development.js"></script>
    <script src="https://unpkg.com/react-dom@18/umd/react-dom.development.js"></script>
    <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>

    
    <script type="text/babel">

        // Header Method
        /**
         * returns the signup header
         */
        function signupHeader() {
            return
            <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl">
                <div class="md:flex">
                <div class="md:shrink-0">
                    <img class="h-48 w-full object-cover md:h-full md:w-48" src="\images\style\skatejamactionshot.jpg" alt="a skateboarder mid trick at an event"/>
                </div>
                <div class="p-8">
                <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">Live. Skate Film Post</div>
                    <p class="block mt-1 text-lg leading-tight font-medium text-black hover:underline">Got no friends who skate?</p>
                    <p class="mt-2 text-slate-500">Wanting to meet likeminded indivuals? like to roll around on a silly peice of wood and do tricks? Perfect you have came to the right place!</p>
                </div>
            </div>
            </div>
        }

        //HomePage function
        /**
         * returnd the homepage
         */
        function HomePage() {
            return (
                <div>
                    <signupHeader />
                    <h1>Skate, Film, Share</h1>
                </div>
            );
        }

        // Get the root DOM node
        const domNode = document.getElementById('app');
        const root = ReactDOM.createRoot(domNode);
        root.render(<HomePage />);
    </script>

</div>
</body>
<footer>
    <?php include('view/footer.php'); ?>
</footer>
</html>