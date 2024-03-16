import * as THREE from 'three';

const renderer = new THREE.WebGLRenderer();

renderer.setSize((0.75*window.innerWidth), (0.75*window.innerHeight));

document.body.appendChild(renderer.domElement);

const scene = new THREE.Scene();
const camera = new THREE.PerspectiveCamera(75, (0.75*window.innerWidth)/(0.75*window.innerHeight), 0.1, 1000);

const axesHelper = new THREE.AxesHelper(5);
scene.add(axesHelper);

camera.position.z = 5;

renderer.render(scene, camera);