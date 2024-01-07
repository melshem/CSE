// Code sample: Animations and bootstrap 2 item carousel.


// Checks if element is in the viewport
function isElementInViewport(el) {
	var rect = el.getBoundingClientRect();
	return (
		rect.top >= 0 &&
		rect.left >= 0 &&
		rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
		rect.right <= (window.innerWidth || document.documentElement.clientWidth)
	);
}

const header = document.querySelector('#header');
const menu = document.querySelector('.navbar');

window.addEventListener('scroll', () => {
	// Add the 'shrink' class to the header menu when scrolled
	if (window.scrollY > 0) {
		menu.classList.add('shrink');
	} else {
		menu.classList.remove('shrink');
	}
});

// Transforms element from below to be visible
window.addEventListener('scroll', function() {
	var scrollTop = window.pageYOffset || document.documentElement.scrollTop;
	var parallaxItems = document.getElementsByClassName('parallax-item');

	for (var i = 0; i < parallaxItems.length; i++) {
		var speed = i + 1; // Adjust the speed of each item as needed
		parallaxItems[i].style.transform = 'translateY(' + (scrollTop / speed) + 'px)';
	}

	var image = document.querySelector('.scroll-image');

	if (isElementInViewport(image.parentNode)) {
		image.classList.add('translate');
	} else {
		image.classList.remove('translate');
	}
});


// Takes in a word array, splits the letters to reveal one at a time, and cycles through the words.
var words = document.getElementsByClassName('word');
var wordArray = [];
var currentWord = 0;

words[currentWord].style.opacity = 1;
for (var i = 0; i < words.length; i++) {
	splitLetters(words[i]);
}

function changeWord() {
	var cw = wordArray[currentWord];
	var nw = currentWord == words.length-1 ? wordArray[0] : wordArray[currentWord+1];

	for (var i = 0; i < cw.length; i++) {
		animateLetterOut(cw, i);
	}
	
	for (var i = 0; i < nw.length; i++) {
		nw[i].className = 'letter behind';
		nw[0].parentElement.style.opacity = 1;
		animateLetterIn(nw, i);
	}
	
	currentWord = (currentWord == wordArray.length-1) ? 0 : currentWord+1;
}

function animateLetterOut(cw, i) {
	setTimeout(function() {
		cw[i].className = 'letter out';
		cw[i].parentElement.className ='word pb-0';
	}, i*80);
}

function animateLetterIn(nw, i) {
	setTimeout(function() {
		nw[i].className = 'letter in';
		nw[i].parentElement.className ='word border-bottom pb-0';
	}, 340+(i*80));
}

function splitLetters(word) {
	var content = word.innerHTML;
	word.innerHTML = '';
	var letters = [];

	for (var i = 0; i < content.length; i++) {
		var letter = document.createElement('span');
		letter.className = 'letter';
		letter.innerHTML = content.charAt(i);
		word.appendChild(letter);
		letters.push(letter);
	}
	
	wordArray.push(letters);
}

changeWord();
setInterval(changeWord, 4000);


// Makes a boostrap carousel to have 2 items per slide
let stats = document.querySelectorAll('.carousel-to-col2 .carousel-item');
var statsArray= Array.prototype.slice.call(stats);
statsArray.forEach(function(el) {
	const statMinPerSlide = 2
	let nextStat = el.nextElementSibling
	for (var s=1; s<statMinPerSlide; s++) {
		if (!nextStat) {
			nextStat = statsArray[0]
		}
		let cloneStatChild = nextStat.cloneNode(true)
		el.appendChild(cloneStatChild.children[0])
		nextStat = nextStat.nextElementSibling
	}
});