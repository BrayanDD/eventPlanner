import './bootstrap';

// document.addEventListener('DOMContentLoaded', function() {
    
//     const inviteButtons = document.querySelectorAll('.invite-button');
    
//     inviteButtons.forEach(button => {
//         button.addEventListener('click', function() {
//             const userId = this.getAttribute('data-user-id');
//             const eventId = "{{ $event->id }}"; 

//             fetch("{{ route('invitations.store') }}", {
//                 method: 'POST',
//                 headers: {
//                     'Content-Type': 'application/json',
//                     'X-CSRF-TOKEN': '{{ csrf_token() }}',
//                 },
//                 body: JSON.stringify({
//                     user_id: userId,
//                     event_id: eventId
//                 })
//             })
//             .then(response => response.json())
//             .then(data => {
//                 if (data.success) {
                   
//                     document.getElementById('user-row-' + userId).classList.add('table-success');
//                     button.textContent = 'Invitado';
//                     button.disabled = true;
//                 } else {
//                     // Mostrar mensaje de error si hubo algún problema
//                     alert('Error al invitar al usuario.');
//                 }
//             })
//             .catch(error => {
//                 console.error('Error:', error);
//             });
//         });
//     });
// });