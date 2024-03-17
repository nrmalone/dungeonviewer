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
                    "GLTFLoader": "https://unpkg.com/three@0.162.0/examples/jsm/loaders/GLTFLoader.js",
                    "OrbitControls": "https://unpkg.com/three@0.162.0/examples/jsm/controls/OrbitControls.js"
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
            <div class="pcDiv" style="max-width: max-content; max-height: 10%; margin-top: 2vh; border-bottom: 5px solid #6A0F0F; margin-left: auto; margin-right: auto; padding: 0 2vw 0 2vw;">
                <table align="center">
                    <tr>
                        <td><button type="button" class="accountButton"><a href="<?=ROOT?>character" style="color: white; text-decoration: none;">← Cancel</a></button></td>
                        <td><h3>Creating avatar for <?=$character->pcName?></h3></td>
                        <td><a href="" style="color: white; text-decoration: none; text-decoration: underline;"></a></td>
                    </tr>
                </table>
                <p align="center" style="margin: 0;">Level <?=$character->pcLevel?> <?=$character->pcRace?> <?=$character->pcClass?></p>
                <table>
                    <tr>
                        <td>STR <?=$character->pcSTR?> &#9672;</td>
                        <td>DEX <?=$character->pcDEX?> &#9672;</td>
                        <td>CON <?=$character->pcCON?> &#9672;</td>
                        <td>INT <?=$character->pcINT?> &#9672;</td>
                        <td>WIS <?=$character->pcWIS?> &#9672;</td>
                        <td>CHA <?=$character->pcCHA?></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                </table>
            </div>
            <script type="module">
                import * as THREE from 'three';
                import {OrbitControls} from 'OrbitControls';
                import {GLTFLoader} from 'GLTFLoader';

                const renderer = new THREE.WebGLRenderer();

                renderer.shadowMap.enabled = true;
                renderer.setSize((0.85*window.innerWidth), (0.63*window.innerHeight));
                //renderer.domElement.style.marginLeft = auto;
                //renderer.domElement.style.marginRight = auto;
                document.body.appendChild(renderer.domElement);

                const scene = new THREE.Scene();
                scene.background = new THREE.Color(0x1E1E1E);
                const camera = new THREE.PerspectiveCamera(75, (0.75*window.innerWidth)/(0.75*window.innerHeight), 0.1, 1000);
                const orbit = new OrbitControls(camera, renderer.domElement);
                camera.position.set(0, 2, 5);
                orbit.update();

                const planeGeometry = new THREE.PlaneGeometry(3, 3);
                const planeMaterial = new THREE.MeshStandardMaterial({
                    color: 0xffffff,
                    side: THREE.DoubleSide
                });
                const plane = new THREE.Mesh(planeGeometry, planeMaterial);
                scene.add(plane);
                plane.rotation.x= -0.5 * Math.PI;
                plane.receiveShadow = true;

                /*
                const boxGeometry = new THREE.BoxGeometry();
                const boxMaterial = new THREE.MeshBasicMaterial({
                    color: 0x00ff00
                });
                const box = new THREE.Mesh(boxGeometry, boxMaterial);
                scene.add(box);
                */

                const loader = new GLTFLoader();
                loader.castShadow = true;

                loader.load('<?=ROOT?>img/characters/samplecharacter.glb', function (gltf) {
                    scene.add(gltf.scene);
                }, undefined, function (error) {
                    console.error(error);
                });

                const directionalLight = new THREE.DirectionalLight(0xFFFFFF, 2);
                scene.add(directionalLight);
                directionalLight.position.set(-30,20,10);
                directionalLight.castShadow = true;
                directionalLight.shadow.camera.bottom = -12;
                const dLightHelper = new THREE.DirectionalLightHelper(directionalLight);
                scene.add(dLightHelper);
                const dLightShadowHelper = new THREE.CameraHelper(directionalLight.shadow.camera);
                scene.add(dLightShadowHelper);

                const axesHelper = new THREE.AxesHelper(5);
                scene.add(axesHelper);

                camera.position.z = 5;
                camera.position.y = 2;
                camera.rotation.x = -0.3;

                renderer.render(scene, camera);

                function animate(time) {
                    //box.rotation.x = time / 1000;
                    //box.rotation.y = time / 1000;

                    renderer.render(scene, camera);
                }
                renderer.setAnimationLoop(animate);
            </script>