function showTable(tableId) {
    // Hide all tables
    const tables = document.querySelectorAll('.table');
    tables.forEach(table => {
        table.style.display = 'none';
    });

    // Remove active class from all menu items
    const menuItems = document.querySelectorAll('.menu-item');
    menuItems.forEach(item => {
        item.classList.remove('active');
    });

    // Show the selected table
    document.getElementById(tableId).style.display = 'block';

    // Add the active class to the clicked menu item
    const activeMenu = Array.from(menuItems).find(item => item.getAttribute('onclick').includes(tableId));
    activeMenu.classList.add('active');
}
