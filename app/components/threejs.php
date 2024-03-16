<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $data['title_page']?></title>

        <link rel="stylesheet" href="<?=ROOT?>css/styles.css">
        <!-- <script async src="https://unpkg.com/es-module-shims@1.8.3/dist/es-module-shims.js"></script> -->
        <script type="importmap">
            {
                "imports": {
                    "three": "https://unpkg.com/three@0.162.0/build/three.module.js",
                    "three/addons/": "https://unpkg.com/three@0.162.0/examples/jsm/"
                }
            }
        </script>
    </head>
    <body>
        <header>            
            <h1 id="homeLinkText"><a class="headerLink" href="<?=ROOT?>">Dungeon Viewer</a></h1>
            <?php if (isset($_SESSION['username'])) {
                echo '<h2 class="headerText"><a class="headerLink" href="' . ROOT . 'campaign">Campaigns</a></h2>';
                echo '<h2 class="headerText"><a class="headerLink" href="' . ROOT . 'character">Characters</a></h2>';
                echo '<h2 class="headerText"><a class="headerLink" href="' . ROOT . 'account">Account</a></h2>';
                echo '<h2 class="headerText"><a class="headerLink" href="' . ROOT . 'account/signout">Sign Out</a></h2>';
            } else {
                echo '<h2 class="headerText"><a class="headerLink" href="' . ROOT . 'account/signin">Sign In</a></h2>';
                echo '<h2 class="headerText"><a class="headerLink" href="' . ROOT . 'account/signup">Create Account</a></h2>';                
            }?>
        </header>
        <main>
            <div>
                
            </div>
            <script type="module">
            import * as THREE from 'three';

            const renderer = new THREE.WebGLRenderer();

            renderer.setSize((0.75*window.innerWidth), (0.75*window.innerHeight));
            //renderer.domElement.style.marginLeft = auto;
            //renderer.domElement.style.marginRight = auto;
            document.body.appendChild(renderer.domElement);

            const scene = new THREE.Scene();
            const camera = new THREE.PerspectiveCamera(75, (0.75*window.innerWidth)/(0.75*window.innerHeight), 0.1, 1000);

            const axesHelper = new THREE.AxesHelper(5);
            scene.add(axesHelper);

            camera.position.z = 5;

            renderer.render(scene, camera);
        </script>