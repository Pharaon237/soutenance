const modal1 = document.getElementById('modal1');
const openModalBtn1 = document.getElementById('openModalBtn1');
const modal = document.getElementById('modal');
const openModalBtn = document.getElementById('openModalBtn');
const closeModalBtn = document.getElementsByClassName('close')[0];
const closeModalBtn1 = document.getElementsByClassName('close')[1];

openModalBtn.onclick = function() {
  modal.style.display = 'block';
}

openModalBtn1.onclick = function() {
    modal1.style.display = 'block';
  }

closeModalBtn.onclick = function() {
  modal.style.display = 'none';
}

closeModalBtn1.onclick = function() {
    modal1.style.display = 'none';
  }

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = 'none';
  }
}



