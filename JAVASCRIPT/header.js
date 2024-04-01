 // dropdown
 function toggleDropdown(dropdownId) {
  var dropdownMenu = document.getElementById(dropdownId);
  dropdownMenu.classList.toggle("show");
}
  
// toggle-button
document.getElementById('sidebarToggle').addEventListener('click', function() {
document.querySelector('.sidebar').classList.toggle('sidebar-open');
    });

    function goBack() {
      window.history.back();
    }

    function goForward() {
      window.history.forward();
    }