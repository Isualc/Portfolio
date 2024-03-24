class TicTacToe {
  constructor() {
      this.initializeBoard(); // Initialize the board with a 3x3 array of empty strings
      this.currentPlayer = 'X'; // Set the initial player to 'X'
  }

  // Initializes the board with a 3x3 array of empty strings
  initializeBoard() {
      this.board = new Array(3).fill().map(() => new Array(3).fill(''));
  }

  // Prints the current state of the board (For console-based debugging)
  printBoard() {
      console.log('\n');
      this.board.forEach((row, index) => {
          console.log(row.join(' | ')); // Print each cell in the row
          if (index < this.board.length - 1) { // Print a line between rows except for the last row
              console.log('-+-+-');
          }
      });
      console.log('\n');
  }

  // Sets the position of the board to the current player
  setPosition(row, col) {
      if (this.board[row][col] === '') { // Check if the selected cell is empty
          this.board[row][col] = this.currentPlayer; // Set the cell to the current player
          return true; // Move was successful
      }
      return false; // Move was not successful, position already taken
  }

  // Switches the current player
  switchPlayer() {
      this.currentPlayer = this.currentPlayer === 'X' ? 'O' : 'X'; // Switch the player
  }

  // Checks if the current player has won or if the game is a draw
  isGameOver() {
      // Check rows
      for (let i = 0; i < 3; i++) {
          if (
            this.board[i][0] === this.currentPlayer &&
            this.board[i][1] === this.currentPlayer &&
            this.board[i][2] === this.currentPlayer
          ) {
            return true;
          }
        }

        // Check columns
        for (let i = 0; i < 3; i++) {
          if (
            this.board[0][i] === this.currentPlayer &&
            this.board[1][i] === this.currentPlayer &&
            this.board[2][i] === this.currentPlayer
          ) {
            return true;
          }
        }

        // Check diagonals
        if (
          this.board[0][0] === this.currentPlayer &&
          this.board[1][1] === this.currentPlayer &&
          this.board[2][2] === this.currentPlayer
        ) {
          return true;
        }

        if (
          this.board[0][2] === this.currentPlayer &&
          this.board[1][1] === this.currentPlayer &&
          this.board[2][0] === this.currentPlayer
        ) {
          return true;
        }

        // Check for draw
        let isDraw = true;
        for (let i = 0; i < 3; i++) {
          for (let j = 0; j < 3; j++) {
            if (this.board[i][j] === '') {
              isDraw = false;
              break;
            }
          }
          if (!isDraw) {
            break;
          }
        }
        if (isDraw) {
          return true;
        }

        return false;
      }
  }


// DOM manipulation and event handling goes here
document.addEventListener('DOMContentLoaded', () => {
  const game = new TicTacToe();
  const boardElement = document.getElementById('gameBoard');
  const statusElement = document.getElementById('gameStatus');
  const restartButton = document.getElementById('restartButton');

  // Function to update the board UI
  function updateBoardUI() {
      boardElement.innerHTML = ''; // Clear the board
      game.board.forEach((row, rowIndex) => {
          row.forEach((cell, colIndex) => {
              const cellElement = document.createElement('div');
              cellElement.textContent = cell;
              cellElement.className = 'cell'; // Assign class for styling
              cellElement.addEventListener('click', () => {
                  if (game.setPosition(rowIndex, colIndex)) {
                      updateBoardUI();
                      if (game.isGameOver()) {
                          statusElement.textContent = `Player ${game.currentPlayer} wins!`;
                      } else {
                          game.switchPlayer();
                          statusElement.textContent = `Player ${game.currentPlayer}'s turn`;
                      }
                  }
              });
              boardElement.appendChild(cellElement);
          });
      });
  }

  updateBoardUI(); // Initialize the board UI

  restartButton.addEventListener('click', () => {
      game.initializeBoard();
      game.currentPlayer = 'X'; // Reset to player X
      statusElement.textContent = "Player X's turn";
      updateBoardUI();
  });
});
