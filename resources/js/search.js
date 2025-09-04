// Search functionality for classes page
function searchClassFunc() {
    const input = document.getElementById('searchClass');
    const filter = input.value.toLowerCase();
    const classGrid = document.getElementById('classGrid');
    const classCards = classGrid.getElementsByClassName('class-card');

    for (let i = 0; i < classCards.length; i++) {
        const card = classCards[i];
        const title = card.getElementsByTagName('h3')[0];
        const description = card.getElementsByTagName('p')[0];
        const time = card.getElementsByClassName('time')[0];
        
        if (title || description || time) {
            const titleText = title ? title.textContent.toLowerCase() : '';
            const descText = description ? description.textContent.toLowerCase() : '';
            const timeText = time ? time.textContent.toLowerCase() : '';
            
            if (titleText.includes(filter) || descText.includes(filter) || timeText.includes(filter)) {
                card.style.display = '';
                card.style.opacity = '1';
                card.style.transform = 'scale(1)';
            } else {
                card.style.display = 'none';
                card.style.opacity = '0';
                card.style.transform = 'scale(0.8)';
            }
        }
    }
    
    // Show "no results" message if no classes found
    const visibleCards = Array.from(classCards).filter(card => card.style.display !== 'none');
    const noResultsMsg = document.getElementById('noResultsMessage');
    
    if (visibleCards.length === 0 && filter.length > 0) {
        if (!noResultsMsg) {
            const message = document.createElement('div');
            message.id = 'noResultsMessage';
            message.className = 'card';
            message.style.textAlign = 'center';
            message.style.color = '#667eea';
            message.innerHTML = `
                <h3>🔍 Không tìm thấy lớp học nào</h3>
                <p>Hãy thử tìm kiếm với từ khóa khác như "yoga", "gym", "sáng", "tối"...</p>
            `;
            classGrid.parentNode.appendChild(message);
        }
    } else if (noResultsMsg) {
        noResultsMsg.remove();
    }
}

// Real-time search
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchClass');
    if (searchInput) {
        searchInput.addEventListener('input', searchClassFunc);
        
        // Add search icon animation
        searchInput.addEventListener('focus', function() {
            this.style.borderColor = '#667eea';
            this.style.boxShadow = '0 0 0 3px rgba(102, 126, 234, 0.1)';
        });
        
        searchInput.addEventListener('blur', function() {
            this.style.borderColor = '#e1e1e1';
            this.style.boxShadow = 'none';
        });
    }
});
