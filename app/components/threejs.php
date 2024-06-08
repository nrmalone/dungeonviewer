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
                    "TextureLoader": "https://unpkg.com/three@0.162.0/src/loaders/TextureLoader.js",
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
                <input type="hidden" id="pcID" value="<?=$character->pcID?>">
                <table align="center">
                    <tr>
                        <td><a href="<?=ROOT?>character" style="color: white; text-decoration: none;"><button type="button" class="accountButton">← Cancel</button></a></td>
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
                import {TextureLoader} from 'TextureLoader';
                import GUI from 'https://cdn.jsdelivr.net/npm/lil-gui@0.19/+esm';
                //create renderer object and attach to body
                const pcID = document.getElementById('pcID').value;

                const loadingManager = new THREE.LoadingManager();
                loadingManager.onLoad = () => {
                    changeOptions(options);
                    loadGUISettings();
                }
                
                const renderer = new THREE.WebGLRenderer();
                renderer.shadowMap.enabled = true;
                renderer.setSize((0.85*window.innerWidth), (0.63*window.innerHeight));
                //renderer.domElement.style.marginLeft = auto;
                //renderer.domElement.style.marginRight = auto;
                document.body.appendChild(renderer.domElement);

                //create scene, camera, and controls
                const scene = new THREE.Scene();
                scene.background = new THREE.Color(0x1E1E1E);
                const camera = new THREE.PerspectiveCamera(75, (0.85*window.innerWidth)/(0.63*window.innerHeight), 0.1, 1000);
                camera.position.set(0, 2, 5);
                let targetPosition = new THREE.Vector3();

                /*
                const orbit = new OrbitControls(camera, renderer.domElement);
                orbit.update();
                */

                //simple white plane for character to stand on
                const planeGeometry = new THREE.PlaneGeometry(30, 30);
                const planeMaterial = new THREE.MeshStandardMaterial({
                    color: 0x1E1E1E,
                    side: THREE.DoubleSide
                });
                const plane = new THREE.Mesh(planeGeometry, planeMaterial);
                scene.add(plane);
                plane.rotation.x= -0.5 * Math.PI;
                plane.receiveShadow = true;

                //create character THREE.Object3D() by loading GLB file thru GLTFLoader()
                const loader = new GLTFLoader(loadingManager);
                let character = new THREE.Object3D();              
                loader.load('<?=ROOT?>img/characters/samplecharacter.glb', function (gltf) {
                    character = gltf.scene;
                    character.name = 'character';
                    character.castShadow = true;
                    scene.add(character);
                    targetPosition.copy(character.position);
                    character.jumpHeight = character.scale.y * 0.6;
                }, undefined, function (error) {
                    console.error(error);
                }, loadingManager);

                const textureLoader = new THREE.TextureLoader(loadingManager);
                //load current character avatar, black sphere when no image is found
                const face = textureLoader.load('<?=ROOT.'img/characters/pcs/user'.$_SESSION['userID'].'pc'.$character->pcID.'.png'?>');
                face.wrapS = THREE.RepeatWrapping;
                face.wrapT = THREE.RepeatWrapping;
                face.repeat.set(2,1);
                face.needsUpdate = true;
                face.encoding = THREE.sRGBEncoding;
                face.rotation = 3;
                const faceMaterial = new THREE.MeshStandardMaterial({
                    map: face,
                    toneMapped: false,
                });
                faceMaterial.side = THREE.DoubleSide;

                let characterFace = new THREE.Object3D();

                loader.load('<?=ROOT?>img/characters/characterhead.glb', function (gltf) {
                    characterFace = gltf.scene;
                    characterFace.name = 'characterFace';
                    characterFace.castShadow = true;
                    characterFace.traverse((o) => {
                        if (o.isMesh) {
                            o.material = faceMaterial;
                        }
                    });
                    scene.add(characterFace);
                }, undefined, function (error) {
                    console.error(error);
                }, loadingManager);

                //castle
                let castle = new THREE.Object3D();
                loader.load('<?=ROOT?>img/characters/castle.glb', function (gltf) {
                    castle = gltf.scene;
                    castle.name = 'castle';
                    castle.castShadow = true;
                    scene.add(castle);
                    castle.scale.set(0.3, 0.3, 0.3);
                    castle.position.set(-8, 0, 0);
                    castle.visible = options.Background === 'Castle';
                }, undefined, function (error) {
                    console.error(error);
                });

                let house1 = new THREE.Object3D();
                loader.load('<?=ROOT?>img/characters/house.glb', function (gltf) {
                    house1 = gltf.scene;
                    house1.name = 'house1';
                    house1.castShadow = true;
                    scene.add(house1);
                    house1.scale.set(0.75, 0.75, 0.75);
                    house1.position.set(-4, 0, -4);
                    house1.rotation.y = 62.5;
                    house1.visible = options.Background === 'Castle';
                });
                let house2 = new THREE.Object3D();
                loader.load('<?=ROOT?>img/characters/house.glb', function (gltf) {
                    house2 = gltf.scene;
                    house2.name = 'house1';
                    house2.castShadow = true;
                    scene.add(house2);
                    house2.scale.set(0.75, 0.75, 0.75);
                    house2.position.set(5, 0, -2);
                    house2.rotation.y = 230;
                    house2.visible = options.Background === 'Castle';
                });

                
                //trees
                var tree = [];
                for (let i = 1; i <= 20; i++) {
                    tree[i] = new THREE.Object3D();
                    loader.load('<?=ROOT?>img/characters/tree.glb', function (gltf) {
                        tree[i]= gltf.scene;
                        tree[i].name = 'tree' + i;
                        tree[i].castShadow = true;
                        scene.add(tree[i]);
                        if (i <= 8) {
                            tree[i].position.set(((10*Math.random())+3), 0, (((-8*Math.random())))-2);
                        } else if (i > 8 && i <= 12) {
                            tree[i].position.set(((4*Math.random())-2), 0, ((-8*Math.random())-2));
                        } else if (i > 12) {
                            tree[i].position.set(((-10*Math.random())-3), 0, ((-8*Math.random())-2));
                        }
                        tree[i].rotation.y = Math.random() * 180;
                        tree[i].scale.set(((0.2*Math.random())+0.6), ((0.2*Math.random())+0.6), ((0.2*Math.random())+0.6));
                        tree[i].visible = options.Background === 'Forest';
                        //console.log('tree' + i + ' ' + tree[i].position.x + ', ' + tree[i].position.y + ', ' + tree[i].position.z);
                    }, undefined, function (error) {
                        console.error(error);
                    });
                }

                let keysPressed = {};
                let isJumping = false;
                let jumpStartTime = 0;
                document.addEventListener('keydown', (event) => {
                    keysPressed[event.key.toLowerCase()] = true;
                    if (event.key.toLowerCase() === ' ' && !isJumping && character) {
                        isJumping = true;
                        jumpStartTime = Date.now();
                    }
                });
                document.addEventListener('keyup', (event) => { keysPressed[event.key.toLowerCase()] = false; });

                
                //simple cube to test positioning
                /*
                const boxGeometry = new THREE.BoxGeometry();
                const boxMaterial = new THREE.MeshBasicMaterial({
                    color: 0x00ff00
                });
                const box = new THREE.Mesh(boxGeometry, boxMaterial);
                box.position.set(0, 0, 0);
                scene.add(box);
                */
                

                // add lighting and helpers for lights, shadows, and axes
                const directionalLight = new THREE.DirectionalLight(0xFFFFFF, 4);
                scene.add(directionalLight);
                directionalLight.position.set(-10,20,40);
                directionalLight.castShadow = true;
                directionalLight.shadow.camera.bottom = -12;

                /*
                const dLightHelper = new THREE.DirectionalLightHelper(directionalLight);
                scene.add(dLightHelper);
                const dLightShadowHelper = new THREE.CameraHelper(directionalLight.shadow.camera);
                scene.add(dLightShadowHelper);

                const axesHelper = new THREE.AxesHelper(5);
                scene.add(axesHelper);
                */

                camera.position.z = 5;
                camera.position.y = 2.5;
                camera.rotation.x = -0.25;

                //testing GUI
                var gui = new GUI();

                //change background & body type
                let options = {Background: 'None', BodyType: 'Human'};
                loadGUISettings();
                
                gui.add(options, 'BodyType', ['Halfling', 'Gnome', 'Dwarf', 'Elf', 'Half-Elf', 'Human', 'Tiefling', 'Half-Orc', 'Dragonborn']);
                gui.add(options, 'Background', ['None', 'Forest', 'Castle']);
                

                function changeOptions(options) {
                    switch (options.value) {
                        case 'None':
                            scene.background = new THREE.Color(0x1E1E1E);
                            plane.material.color.set(0x1E1E1E);
                            castle.visible = false;
                            house1.visible = false;
                            house2.visible = false;
                            tree.forEach((i) => {
                                i.visible = false;
                            });
                        break;
                        case 'Forest':
                            scene.background = new THREE.Color(0xA4F7F0);
                            plane.material.color.set(0x67A260);
                            castle.visible = false;
                            house1.visible = false;
                            house2.visible = false;
                            /*
                            for (let i = 1; i<=10; i++) {
                                tree[i].visible = true;
                            }
                            */
                           tree.forEach((i) => {
                            i.visible = true;
                           });
                        break;
                        case 'Castle':
                            scene.background = new THREE.Color(0xA6C6CC);
                            plane.material.color.set(0x6F5C30);
                            castle.visible = true;
                            house1.visible = true;
                            house2.visible = true;
                            tree.forEach((i) => {
                                i.visible = false;
                            });
                        break;
                        //
                        case 'Halfling':
                            character.scale.set(0.6, 0.5, 0.6);
                            characterFace.scale.set(0.6, 0.5, 0.6);
                        break;
                        case 'Gnome':
                            character.scale.set(0.7, 0.57, 0.7);
                            characterFace.scale.set(0.7, 0.57, 0.7);
                        break;
                        case 'Dwarf':
                            character.scale.set(1, 0.68, 1);
                            characterFace.scale.set(1, 0.68, 1);
                        break;
                        case 'Elf':
                            character.scale.set(0.8, 0.9, 0.8);
                            characterFace.scale.set(0.8, 0.9, 0.8);
                        break;
                        case 'Half-Elf':
                            character.scale.set(0.9, 0.93, 0.9);
                            characterFace.scale.set(0.9, 0.93, 0.9);
                        break;
                        case 'Human':
                            character.scale.set(1, 1, 1);
                            characterFace.scale.set(1, 1, 1);
                        break;
                        case 'Tiefling':
                            character.scale.set(1.1, 1, 1.1);
                            characterFace.scale.set(1.1, 1, 1.1);
                        break;
                        case 'Half-Orc':
                            character.scale.set(1.2, 1.07, 1.2);
                            characterFace.scale.set(1.2, 1.07, 1.2);
                        break;
                        case 'Dragonborn':
                            character.scale.set(1, 1.1, 1);
                            characterFace.scale.set(1, 1.1, 1);
                        break;
                    }
                }
                gui.onChange(options => {
                    //backgrounds
                    changeOptions(options);
                    saveGUISettings();
                });

                function saveGUISettings() {
                    const cookieData = {
                        Background: options.Background,
                        BodyType: options.BodyType
                    };

                    const cookieString = JSON.stringify(cookieData);
                    document.cookie = eval(new String("guiSetting" + pcID)) + "=" + cookieString + "; expires=" + getCookieExpiry() + "; path=/"; 
                }

                function getCookieExpiry() {
                    const now = new Date();
                    const expiry = new Date(now.getTime() + 365 * 24 * 60 * 60 * 1000); // 1 year
                    return expiry.toUTCString();
                }

                function loadGUISettings() {
                    const cookies = document.cookie.split(';');
                    for (let i = 0; i < cookies.length; i++) {
                        const cookiePair = cookies[i].trim().split('=');
                        if (cookiePair[0] == (eval(new String('guiSetting' + pcID)))) {
                        const cookieData = JSON.parse(cookiePair[1]);

                        options.Background= cookieData.Background;
                        options.BodyType = cookieData.BodyType;
						
						// Update scene background and plane color based on the loaded settings
						switch (options.Background) {
							case 'None':
								scene.background = new THREE.Color(0x1E1E1E);
								plane.material.color.set(0x1E1E1E);
								break;
							case 'Forest':
								scene.background = new THREE.Color(0xA4F7F0);
								plane.material.color.set(0x67A260);
								break;
							case 'Castle':
								scene.background = new THREE.Color(0xA6C6CC);
								plane.material.color.set(0x6F5C30);
								break;
						}
                        switch (options.BodyType) {
                            case 'Halfling':
                                character.scale.set(0.6, 0.5, 0.6);
                                characterFace.scale.set(0.6, 0.5, 0.6);
                            break;
                            case 'Gnome':
                                character.scale.set(0.7, 0.57, 0.7);
                                characterFace.scale.set(0.7, 0.57, 0.7);
                            break;
                            case 'Dwarf':
                                character.scale.set(1, 0.68, 1);
                                characterFace.scale.set(1, 0.68, 1);
                            break;
                            case 'Elf':
                                character.scale.set(0.8, 0.9, 0.8);
                                characterFace.scale.set(0.8, 0.9, 0.8);
                            break;
                            case 'Half-Elf':
                                character.scale.set(0.9, 0.93, 0.9);
                                characterFace.scale.set(0.9, 0.93, 0.9);
                            break;
                            case 'Human':
                                character.scale.set(1, 1, 1);
                                characterFace.scale.set(1, 1, 1);
                            break;
                            case 'Tiefling':
                                character.scale.set(1.1, 1, 1.1);
                                characterFace.scale.set(1.1, 1, 1.1);
                            break;
                            case 'Half-Orc':
                                character.scale.set(1.2, 1.07, 1.2);
                                characterFace.scale.set(1.2, 1.07, 1.2);
                            break;
                            case 'Dragonborn':
                                character.scale.set(1, 1.1, 1);
                                characterFace.scale.set(1, 1.1, 1);
                            break;
                        }

                        // Trigger update for GUI elements
                        gui.controllers.forEach(controller => controller.updateDisplay());
                        // ... and scene objects, see next point
                        changeOptions(options); 
                        
                        return; // Settings loaded
                        }
                    }
                }

                //EventListener for automatic resizing of window
                window.addEventListener('resize', function(e) {
                    camera.aspect = (0.85*window.innerWidth) / (0.63*window.innerHeight);
                    camera.updateProjectionMatrix();

                    renderer.setSize((0.85*window.innerWidth), 0.63*(window.innerHeight));
                });

                function checkMovement() {
                    let movementAdjusted = false;
                    if (character.position.x <= -12.5) {
                        character.position.x = -12;
                        movementAdjusted = true;
                    }
                    if (character.position.x >= 12.5) {
                        character.position.x = 12;
                        movementAdjusted = true;
                    }
                    if (character.position.z <= -12.5) {
                        character.position.z = -12;
                        movementAdjusted = true;
                    }
                    if (character.position.z >= 12.5) {
                        character.position.z = 12;
                        movementAdjusted = true;
                    }
                    if (movementAdjusted) {
                        return false;
                    } else {
                        return true;
                    }
                }

                //animation loop for renderer
                function animate(time) {
                    if (character) {
                        const moveSpeed = 0.05;
                        const charRotateSpeed = 0.05;
                        const cameraRotateSpeed = 0.01;

                        //rotate character
                        if (keysPressed['q']) { character.rotateY(charRotateSpeed); }
                        if (keysPressed['e']) { character.rotateY(-charRotateSpeed); }

                        const direction = new THREE.Vector3();
                        camera.getWorldDirection(direction);
                        direction.y = 0;
                        direction.normalize();

                        if (keysPressed['w']) {
                            if (checkMovement()) { character.translateOnAxis(direction, moveSpeed); }
                        }
                        if (keysPressed['s']) {
                            if (checkMovement()) { character.translateOnAxis(direction, -moveSpeed); }
                        }
                        if (keysPressed['a']) {
                            if (checkMovement()) { character.translateOnAxis(new THREE.Vector3(direction.z, 0, -direction.x), moveSpeed); }
                        }
                        if (keysPressed['d']) {
                            if (checkMovement()) { character.translateOnAxis(new THREE.Vector3(-direction.z, 0, direction.x), moveSpeed); }
                        }

                        //zoom in and out
                        if (keysPressed['=']) {
                            if (camera.fov > 15) {
                                camera.fov -= 0.5;
                                camera.updateProjectionMatrix();
                            }
                        }
                        if (keysPressed['-']) {
                            if (camera.fov < 115) {
                                camera.fov += 0.5;
                                camera.updateProjectionMatrix();
                            }
                        }

                        //rotate camera
                        if (keysPressed['i']) {
                            if (camera.rotation.x < 0.25) {
                                camera.rotation.x += cameraRotateSpeed;
                                camera.updateProjectionMatrix();
                            }
                        }
                        if (keysPressed['k']) {
                            if (camera.rotation.x > -0.75) {
                                camera.rotation.x -= cameraRotateSpeed;
                                camera.updateProjectionMatrix();
                            }
                        }
                        if (keysPressed['j']) {
                            if (camera.rotation.y < 0.65) {
                                camera.rotation.y += cameraRotateSpeed;
                                camera.updateProjectionMatrix();
                            }
                        }
                        if (keysPressed['l']) {
                            if (camera.rotation.y > -0.65) {
                                camera.rotation.y -= cameraRotateSpeed;
                                camera.updateProjectionMatrix();
                            }
                        }

                        characterFace.position.copy(character.position);
                        characterFace.rotation.copy(character.rotation);
                        character.updateMatrixWorld();

                        if (isJumping) {
                            const jumpTime = (Date.now() - jumpStartTime) / 800;
                            const jumpProgress = Math.min(jumpTime / 0.5, 1);
                            character.position.y = Math.sin(jumpProgress * Math.PI) * character.jumpHeight;

                            if (jumpProgress >= 1) {
                                isJumping = false;
                                character.position.y = 0;
                            }
                        }

                        targetPosition.lerp(character.position, 0.1);

                        camera.position.copy(targetPosition);
                        camera.position.y += 2;
                        camera.position.z += 5;
                    }

                    renderer.render(scene, camera);
                }
                renderer.setAnimationLoop(animate);
            </script>