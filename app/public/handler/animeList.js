// document.addEventListener('DOMContentLoaded', function() {
//     document.querySelectorAll('.add-list-btn').forEach(function(button) {
//         button.addEventListener('click', function(e) {
//             e.preventDefault();

//             let clientId = e.target.getAttribute('data-client-id');
//             let animeId = e.target.getAttribute('data-anime-id');

//             window.location.href = 
//                 `/api/anime_list/add.php?client_id=${clientId}&anime_id=${animeId}`;
//         });
//     });
// });

// document.addEventListener('DOMContentLoaded', function() {
//     document.querySelectorAll('.remove-list-btn').forEach(function(button) {
//         button.addEventListener('click', function(e) {
//             e.preventDefault();

//             let listId = e.target.getAttribute('data-list-id');

//             window.location.href = 
//                 `/api/anime_list/delete.php?id=${listId}`;
//         });
//     });
// });