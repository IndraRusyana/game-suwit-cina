let userScore = 0;
let computerScore = 0;
const userScore_span = document.getElementById('user-score');
const computerScore_span = document.getElementById('computer-score');
const scoreBoard_div = document.querySelector('.score-board');
const result_p = document.querySelector('.result > p');
const rock_div = document.getElementById('r');
const paper_div = document.getElementById('p');
const scissors_div = document.getElementById('s');
const imgComputer = document.querySelector('.images-comp > img');

function getComputerChoice() {
	const choices = ['r', 'p' , 's'];
	const randomNumber = Math.floor(Math.random() * 3);
	return choices[randomNumber];
}

function convertToWord(word) {
	if (word === 'r') return 'Rock';
	if (word === 'p') return 'Paper';
	return 'Scissors'
}

function win(userChoice, computerChoice) {
	const userChoice_div = document.getElementById(userChoice);
	userScore++;
	userScore_span.innerHTML = userScore;
	result_p.innerHTML =  `${convertToWord(userChoice)}. beats ${convertToWord(computerChoice)}. You Win ` ;
	userChoice_div.classList.add('green-glow');
	
	setTimeout(function() {
		userChoice_div.classList.remove('green-glow')
	}, 800);

	imgComputer.setAttribute('src','images/' + `${convertToWord(computerChoice)}` + '.png');
	setTimeout(function() {
		imgComputer.setAttribute('src','images/tandatanya.png')
	}, 1800);
}

function lose(userChoice, computerChoice) {
	const userChoice_div = document.getElementById(userChoice);
	computerScore++;
	computerScore_span.innerHTML = computerScore;
	result_p.innerHTML =  `${convertToWord(userChoice)}. beats ${convertToWord(computerChoice)}. You Lose ` ;
	userChoice_div.classList.add('red-glow');
	
	setTimeout(function() {
		userChoice_div.classList.remove('red-glow')
	}, 800);

	imgComputer.setAttribute('src','images/' + `${convertToWord(computerChoice)}` + '.png');
	setTimeout(function() {
		imgComputer.setAttribute('src','images/tandatanya.png')
	}, 1800);
}

function draw(userChoice, computerChoice) {
	const userChoice_div = document.getElementById(userChoice);
	result_p.innerHTML =  `${convertToWord(userChoice)}. with ${convertToWord(computerChoice)}. Its Draw ` ;
	document.getElementById(userChoice).classList.add('gray-glow');
	
	setTimeout(function() {
		document.getElementById(userChoice).classList.remove('gray-glow')
	}, 800);

	imgComputer.setAttribute('src','images/' + `${convertToWord(computerChoice)}` + '.png');
	setTimeout(function() {
		imgComputer.setAttribute('src','images/tandatanya.png')
	}, 1800);
}

function game(userChoice) {
	const computerChoice = getComputerChoice();
	switch (userChoice + computerChoice){
		case 'rs':
		case 'pr':
		case 'sp':
			win(userChoice, computerChoice);
			break;
		case 'sr':
		case 'rp':
		case 'ps':
			lose(userChoice, computerChoice);
			break;
		case 'rr':
		case 'pp':
		case 'ss':
			draw(userChoice, computerChoice);
			break;
	}	
}

function main() {
	rock_div.addEventListener('click', function() {
		game('r');
	})
	paper_div.addEventListener('click', function() {
		game('p');
	})
	scissors_div.addEventListener('click', function() {
		game('s');
	})
}

main();