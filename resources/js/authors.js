/**
 * Authors page JavaScript functionality
 */

// DOM Content Loaded
document.addEventListener('DOMContentLoaded', function() {
    initializeAuthorsPage();
});

/**
 * Initialize authors page functionality
 */
function initializeAuthorsPage() {
    setupCardAnimations();
    setupSocialLinkHovers();
    setupSkillTagAnimations();
    addScrollAnimations();
}

/**
 * Setup card hover animations
 */
function setupCardAnimations() {
    const authorCards = document.querySelectorAll('.author-card');
    
    authorCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-10px) scale(1.02)';
            this.style.boxShadow = '0 20px 60px rgba(102, 126, 234, 0.2)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
            this.style.boxShadow = '0 10px 40px rgba(0,0,0,0.1)';
        });
    });
}

/**
 * Setup social links hover effects
 */
function setupSocialLinkHovers() {
    const socialLinks = document.querySelectorAll('.social-link');
    
    socialLinks.forEach(link => {
        link.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-3px) rotate(360deg)';
            this.style.boxShadow = '0 8px 25px rgba(102, 126, 234, 0.5)';
        });
        
        link.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) rotate(0deg)';
            this.style.boxShadow = '0 3px 15px rgba(102, 126, 234, 0.3)';
        });
    });
}

/**
 * Setup skill tag animations
 */
function setupSkillTagAnimations() {
    const skillTags = document.querySelectorAll('.skill-tag');
    
    skillTags.forEach(tag => {
        tag.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.1) rotate(5deg)';
            this.style.boxShadow = '0 5px 15px rgba(102, 126, 234, 0.4)';
        });
        
        tag.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1) rotate(0deg)';
            this.style.boxShadow = '0 2px 8px rgba(102, 126, 234, 0.2)';
        });
    });
}

/**
 * Add scroll animations for cards
 */
function addScrollAnimations() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);
    
    // Observe author cards
    const authorCards = document.querySelectorAll('.author-card');
    authorCards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(50px)';
        card.style.transition = `opacity 0.6s ease ${index * 0.1}s, transform 0.6s ease ${index * 0.1}s`;
        observer.observe(card);
    });
    
    // Observe project info
    const projectInfo = document.querySelector('.project-info');
    if (projectInfo) {
        projectInfo.style.opacity = '0';
        projectInfo.style.transform = 'translateY(30px)';
        projectInfo.style.transition = 'opacity 0.8s ease 0.3s, transform 0.8s ease 0.3s';
        observer.observe(projectInfo);
    }
}

/**
 * Animate statistics numbers
 */
function animateStatNumbers() {
    const statNumbers = document.querySelectorAll('.stat-number');
    
    statNumbers.forEach(stat => {
        const finalNumber = stat.textContent.replace(/[^0-9]/g, '');
        if (finalNumber) {
            let current = 0;
            const increment = Math.ceil(finalNumber / 50);
            const timer = setInterval(() => {
                current += increment;
                if (current >= finalNumber) {
                    stat.textContent = stat.textContent.replace(/[0-9]+/, finalNumber);
                    clearInterval(timer);
                } else {
                    stat.textContent = stat.textContent.replace(/[0-9]+/, current);
                }
            }, 30);
        }
    });
}

/**
 * Add click effects to author cards
 */
function addCardClickEffects() {
    const authorCards = document.querySelectorAll('.author-card');
    
    authorCards.forEach(card => {
        card.addEventListener('click', function(e) {
            // Create ripple effect
            const ripple = document.createElement('span');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;
            
            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';
            ripple.classList.add('ripple-effect');
            
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });
}

/**
 * Smooth scroll to sections
 */
function setupSmoothScroll() {
    const links = document.querySelectorAll('a[href^="#"]');
    
    links.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);
            
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
}

/**
 * Add typing effect to intro text
 */
function addTypingEffect() {
    const introText = document.querySelector('.authors-intro p');
    if (introText) {
        const originalText = introText.textContent;
        introText.textContent = '';
        
        let index = 0;
        const typeWriter = () => {
            if (index < originalText.length) {
                introText.textContent += originalText.charAt(index);
                index++;
                setTimeout(typeWriter, 20);
            }
        };
        
        // Start typing effect after a delay
        setTimeout(typeWriter, 1000);
    }
}

// Initialize additional features when window loads
window.addEventListener('load', function() {
    setTimeout(animateStatNumbers, 500);
    addCardClickEffects();
    setupSmoothScroll();
});

// CSS for ripple effect
const style = document.createElement('style');
style.textContent = `
    .author-card {
        position: relative;
        overflow: hidden;
    }
    
    .ripple-effect {
        position: absolute;
        border-radius: 50%;
        background: rgba(102, 126, 234, 0.3);
        transform: scale(0);
        animation: ripple 0.6s linear;
        pointer-events: none;
    }
    
    @keyframes ripple {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }
    
    .tech-item {
        transition: all 0.3s ease;
    }
    
    .tech-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }
`;
document.head.appendChild(style);
