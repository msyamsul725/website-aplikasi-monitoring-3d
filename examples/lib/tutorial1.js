

var scene = new THREE.Scene();
var cam = new THREE.PerspectiveCamera(45,innerWidth/innerHeight, 1,100);

var renderer = new THREE.WebGLRenderer();

var box = new THREE.BoxGeometry(1,1,1);
var boxMat = new THREE.MeshBasicMaterial({color:0x00ff00});
var boxMesh = new THREE.Mesh(box, boxMat);

scene.add(boxMesh);
cam.position.z = 5;

renderer.setSize(innerWidth, innerHeight);
document.body.appendChild(renderer.domElement);

window.addEventListener('resize', function() {
	renderer.setSize(this.window.innerWidth, this.window.innerHeight);
	cam.aspect = this.window.innerWidth/this.window.innerHeight;
	cam.updateProjectionMatrix();

});

function draw() {
    requestAnimationFrame(draw);
    boxMesh.rotation.y += 0.01;
    renderer.render(scene, cam);
}


draw();


renderer.render(scene, cam);
