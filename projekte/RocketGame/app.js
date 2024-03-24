const app = new PIXI.Application({
    width: 800, // Example width, adjust as needed
    height: 600, // Example height, adjust as needed
});
document.getElementById('game-container').appendChild(app.view);

const ufoList = [];
// document.body.appendChild(app.view);

let ufoShotDown = 0;

const rocket = PIXI.Sprite.from("assets/rocket1.png");
rocket.x = 350;
rocket.y = 520;
rocket.scale.x = 0.05;
rocket.scale.y = 0.05;
app.stage.addChild(rocket);

gameInterval(function () {
  const ufo = PIXI.Sprite.from("assets/ufo2.png");
  ufo.x = random(0, 700);
  ufo.y = -25;
  ufo.scale.x = 0.1;
  ufo.scale.y = 0.1;
  app.stage.addChild(ufo);
  ufoList.push(ufo);
  flyDown(ufo, 0.5);


  waitForCollision(ufo, rocket).then(function () {
    app.stage.removeChild(rocket);
    stopGame();

    function endGame() {
      const message = new PIXI.Text('YOUR SCORE: ' + ufoShotDown + ' UFOS.', {fontFamily : 'Arial', fontSize: 24, fill : 0xffffff, align : 'center'});
      message.anchor.set(0.5);
      message.x = app.screen.width / 2;
      message.y = app.screen.height / 1.2;
      app.stage.addChild(message);
  }
    if (stopGame) {
      const gameOver = PIXI.Sprite.from("assets/gameover.png");
      gameOver.anchor.set(0.5); // Setzt den Ankerpunkt in die Mitte des Sprites
      gameOver.x = app.screen.width / 2; // Setzt die x-Position in die Mitte des Bildschirms
      gameOver.y = app.screen.height / 2; // Setzt die y-Position in die Mitte des Bildschirms
      gameOver.scale.x = 0.5;
      gameOver.scale.y = 0.5;
      app.stage.addChild(gameOver);

      endGame(); // Rufen Sie die endGame-Funktion auf
    }
});
}, 1000);


function leftKeyPressed() {
    if (rocket.x > 0) {
        rocket.x -= 5;
    }
}

function rightKeyPressed() {
    if (rocket.x < app.screen.width - rocket.width) { // Ensure rocket doesn't move beyond the right boundary
        rocket.x += 5;
    }
}


  function upKeyPressed() {
    if (rocket.y > 0) {
      rocket.y -= 5;
    }
  }

  function downKeyPressed() {
    // Überprüft, ob der Rocket unterhalb der unteren Grenze ist
    if (rocket.y < app.screen.height - rocket.height) {
        rocket.y += 5; // Bewegt den Rocket um 5 Einheiten nach unten
    }
}

function shiftpKeyPressed() {
    const bullet = PIXI.Sprite.from("assets/bullet1.png");
    bullet.x = rocket.x + 20;
    bullet.y = rocket.y - 20;
    bullet.scale.x = 0.02;
    bullet.scale.y = 0.02;
    app.stage.addChild(bullet);
    flyUp(bullet, 5);
    }


  function spaceKeyPressed() {
    const lazer = createLazerBeam();
    app.stage.addChild(lazer);

    waitForCollision(lazer, ufoList).then(function ([lazer, ufo]) {
      app.stage.removeChild(ufo);
      app.stage.removeChild(lazer);
      ufoShotDown++;
    });
  }

  function createLazerBeam() {
    const lazerBeam = new PIXI.Container();

    for (let i = 0; i < 10; i++) {
      const lazer = PIXI.Sprite.from("assets/lazer.png");
      lazer.x = rocket.x + 20;
      lazer.y = rocket.y - 20;
      lazer.scale.x = 0.02;
      lazer.scale.y = 0.02;
      lazerBeam.addChild(lazer);
      flyUp(lazer, 5);
    }

    return lazerBeam;
  }

   