/**
 * Table of Contents functionality for Arorms theme
 * Highlights current section in TOC while scrolling
 */

document.addEventListener('DOMContentLoaded', function() {
    const tocWidget = document.querySelector('.toc-widget');
    const tocItems = document.querySelectorAll('.toc-item');
    
    if (!tocWidget || tocItems.length === 0) {
        return;
    }
    
    // Get all section elements that correspond to TOC items
    const sections = [];
    tocItems.forEach(item => {
        const href = item.getAttribute('href');
        if (href && href.startsWith('#')) {
            const id = href.substring(1);
            const section = document.getElementById(id);
            if (section) {
                sections.push({
                    id: id,
                    element: section,
                    tocItem: item,
                    top: 0
                });
            }
        }
    });
    
    if (sections.length === 0) {
        return;
    }
    
    // Calculate section positions
    function calculateSectionPositions() {
        sections.forEach(section => {
            const rect = section.element.getBoundingClientRect();
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            section.top = rect.top + scrollTop - 100; // Offset for better UX
        });
        
        // Sort sections by position
        sections.sort((a, b) => a.top - b.top);
    }
    
    // Update active TOC item based on scroll position
    function updateActiveTOCItem() {
        const scrollPosition = window.pageYOffset || document.documentElement.scrollTop;
        
        // Remove active class from all items
        tocItems.forEach(item => {
            item.classList.remove('active');
        });
        
        // Find current active section
        let currentSection = null;
        
        for (let i = sections.length - 1; i >= 0; i--) {
            if (scrollPosition >= sections[i].top) {
                currentSection = sections[i];
                break;
            }
        }
        
        // If no section found, use the first one
        if (!currentSection && sections.length > 0) {
            currentSection = sections[0];
        }
        
        // Add active class to current section's TOC item
        if (currentSection) {
            currentSection.tocItem.classList.add('active');
            
            // Only scroll TOC item into view if user is actively scrolling up (not at bottom)
            // This prevents unwanted scrolling when user reaches bottom of page
            const tocNav = document.querySelector('.toc-nav');
            if (tocNav && !isAtBottomOfPage()) {
                const itemRect = currentSection.tocItem.getBoundingClientRect();
                const navRect = tocNav.getBoundingClientRect();
                
                // Only scroll if item is completely outside viewport
                if (itemRect.bottom > navRect.bottom + 10 || itemRect.top < navRect.top - 10) {
                    currentSection.tocItem.scrollIntoView({
                        behavior: 'smooth',
                        block: 'nearest'
                    });
                }
            }
        }
        
        // Helper function to check if user is at bottom of page
        function isAtBottomOfPage() {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            const scrollHeight = document.documentElement.scrollHeight;
            const clientHeight = document.documentElement.clientHeight;
            
            // Check if within 100px of bottom
            return (scrollTop + clientHeight) >= (scrollHeight - 100);
        }
    }
    
    // Smooth scroll to section when TOC item is clicked
    tocItems.forEach(item => {
        item.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href && href.startsWith('#')) {
                const targetId = href.substring(1);
                const targetElement = document.getElementById(targetId);
                
                if (targetElement) {
                    e.preventDefault();
                    
                    // Calculate offset for fixed header
                    const headerHeight = document.querySelector('header')?.offsetHeight || 80;
                    const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - headerHeight;
                    
                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                    
                    // Update URL hash without jumping
                    history.pushState(null, null, href);
                }
            }
        });
    });
    
    // Initialize
    calculateSectionPositions();
    updateActiveTOCItem();
    
    // Recalculate on resize and scroll
    let resizeTimer;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            calculateSectionPositions();
            updateActiveTOCItem();
        }, 250);
    });
    
    let scrollTimer;
    window.addEventListener('scroll', function() {
        clearTimeout(scrollTimer);
        scrollTimer = setTimeout(updateActiveTOCItem, 100);
    });
    
    // Recalculate when images load (they can affect layout)
    const images = document.querySelectorAll('img');
    images.forEach(img => {
        if (!img.complete) {
            img.addEventListener('load', function() {
                calculateSectionPositions();
                updateActiveTOCItem();
            });
        }
    });
    
    // Handle dynamic content (like lazy loaded content)
    const observer = new MutationObserver(function() {
        calculateSectionPositions();
        updateActiveTOCItem();
    });
    
    // Observe content changes
    const contentArea = document.querySelector('.prose, article');
    if (contentArea) {
        observer.observe(contentArea, {
            childList: true,
            subtree: true
        });
    }
});