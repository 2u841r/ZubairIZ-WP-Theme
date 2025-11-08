(function() {
    'use strict';
    
    // Initialize when DOM is ready
    function initTheme() {
        const htmlElement = document.documentElement;

        // Load saved theme immediately
        const savedTheme = localStorage.getItem('theme') || 'light';
        htmlElement.setAttribute('data-theme', savedTheme);

        // Event delegation for theme controller buttons
        document.addEventListener('click', function(e) {
            const target = e.target;
            
            // Check for theme controller button
            let themeBtn = null;
            if (target.classList.contains('theme-controller')) {
                themeBtn = target;
            } else {
                themeBtn = target.closest('.theme-controller');
            }
            
            if (themeBtn) {
                const theme = themeBtn.getAttribute('data-set-theme');
                if (theme) {
                    htmlElement.setAttribute('data-theme', theme);
                    localStorage.setItem('theme', theme);
                }
            }

            // Check for view toggle button
            let viewBtn = null;
            if (target.classList.contains('view-toggle')) {
                viewBtn = target;
            } else {
                viewBtn = target.closest('.view-toggle');
            }
            
            if (viewBtn) {
                const view = viewBtn.getAttribute('data-view');
                if (view) {
                    // Update active state
                    const allToggles = document.querySelectorAll('.view-toggle');
                    allToggles.forEach(btn => {
                        btn.classList.remove('active', 'btn-primary');
                    });
                    viewBtn.classList.add('active', 'btn-primary');

                    // Save and apply view
                    localStorage.setItem('view', view);
                    setView(view);
                }
            }
        });

        // Setup initial view
        setupViewToggle();
    }

    function setupViewToggle() {
        const postsContainer = document.getElementById('posts-container');
        const viewToggles = document.querySelectorAll('.view-toggle');

        if (postsContainer && viewToggles.length > 0) {
            // Load saved view
            const savedView = localStorage.getItem('view') || 'grid';
            setView(savedView);

            // Set initial active state
            viewToggles.forEach(button => {
                const buttonView = button.getAttribute('data-view');
                if (buttonView === savedView) {
                    button.classList.add('active', 'btn-primary');
                } else {
                    button.classList.remove('active', 'btn-primary');
                }
            });
        }
    }

    function setView(view) {
        // Always get fresh container reference
        let container = document.getElementById('posts-container');
        if (!container) return;

        if (view === 'list') {
            // Convert container to DaisyUI list if it's not already
            if (container.tagName !== 'UL') {
                const newUl = document.createElement('ul');
                newUl.className = 'list bg-base-100 rounded-box shadow-md';
                newUl.id = 'posts-container';
                
                // Move all posts to new ul
                while (container.firstChild) {
                    newUl.appendChild(container.firstChild);
                }
                
                // Replace container with ul
                container.parentNode.replaceChild(newUl, container);
                container = newUl;
            } else {
                container.className = 'list bg-base-100 rounded-box shadow-md';
            }

            // Update post items for list view - get all articles/items
            const postItems = container.querySelectorAll('article, li.post-item, .post-item');

            postItems.forEach(item => {
                // Get elements before converting
                const figure = item.querySelector('figure');
                const thumbnail = item.querySelector('.post-thumbnail');
                const title = item.querySelector('.post-title a') || item.querySelector('.card-title a');
                const dateEl = item.querySelector('.post-date time') || item.querySelector('time');
                const excerpt = item.querySelector('.post-excerpt');

                // Store original structure if not already stored (only from article)
                if (item.tagName === 'ARTICLE' && !item.dataset.originalStructure) {
                    item.dataset.originalStructure = item.outerHTML;
                }

                // Get post URL before conversion
                const postUrl = item.dataset.postUrl || (title ? title.getAttribute('href') : '#') || '';

                // Convert article to li if needed
                let listItem = item;
                if (item.tagName === 'ARTICLE') {
                    const newLi = document.createElement('li');
                    newLi.className = item.className + ' list-row list-clickable post-item';
                    newLi.id = item.id;
                    newLi.dataset.postUrl = postUrl;
                    newLi.dataset.originalStructure = item.dataset.originalStructure;
                    item.parentNode.replaceChild(newLi, item);
                    listItem = newLi;
                } else if (item.tagName === 'LI') {
                    // If already an li, just update classes and preserve URL
                    listItem.classList.add('list-row', 'list-clickable', 'post-item');
                    if (!listItem.dataset.postUrl && postUrl) {
                        listItem.dataset.postUrl = postUrl;
                    }
                    if (!listItem.dataset.originalStructure && item.querySelector('article')) {
                        listItem.dataset.originalStructure = item.querySelector('article').outerHTML;
                    }
                } else {
                    listItem.classList.add('list-row', 'list-clickable', 'post-item');
                    if (postUrl) listItem.dataset.postUrl = postUrl;
                }

                // Build list-row structure
                let newHTML = '';

                // Image (size-10 rounded-box)
                if (thumbnail) {
                    const imgSrc = thumbnail.getAttribute('src');
                    newHTML += `<div><img class="size-10 rounded-box object-cover" src="${imgSrc}" alt=""/></div>`;
                } else if (figure) {
                    const img = figure.querySelector('img');
                    if (img) {
                        const imgSrc = img.getAttribute('src');
                        newHTML += `<div><img class="size-10 rounded-box object-cover" src="${imgSrc}" alt=""/></div>`;
                    } else {
                        newHTML += `<div></div>`;
                    }
                } else {
                    newHTML += `<div></div>`;
                }

                // Title and Date container (with padding)
                newHTML += `<div class="px-2">`;
                // Title (bold, bigger but not too much)
                if (title) {
                    const titleText = title.textContent || title.innerText;
                    newHTML += `<div class="font-bold text-base md:text-lg mb-1">${titleText}</div>`;
                }
                // Date (instead of song name)
                if (dateEl) {
                    const dateText = dateEl.textContent || dateEl.innerText;
                    newHTML += `<div class="text-xs uppercase font-semibold opacity-60">${dateText}</div>`;
                }
                newHTML += `</div>`;

                // Excerpt (always same word count/line count) - with padding
                if (excerpt) {
                    const excerptText = excerpt.textContent || excerpt.innerText;
                    // Trim to consistent length (approximately 80-100 characters)
                    const trimmedExcerpt = excerptText.length > 100 ? excerptText.substring(0, 100) + '...' : excerptText;
                    newHTML += `<p class="list-col-wrap text-xs px-2">${trimmedExcerpt}</p>`;
                }

                // Read More button - keep as "Read More"
                const finalPostUrl = listItem.dataset.postUrl || postUrl || '#';
                newHTML += `<a href="${finalPostUrl}" class="btn btn-ghost btn-sm read-more-btn-list" title="Read More">Read More</a>`;

                // Replace content
                listItem.innerHTML = newHTML;

                // Make full row clickable
                listItem.style.cursor = 'pointer';
                const clickUrl = listItem.dataset.postUrl || postUrl || '#';
                
                // Remove any existing click listeners by cloning
                const newListItem = listItem.cloneNode(true);
                newListItem.dataset.postUrl = clickUrl;
                listItem.parentNode.replaceChild(newListItem, listItem);
                listItem = newListItem;
                
                listItem.addEventListener('click', function(e) {
                    // Don't trigger if clicking the button
                    if (!e.target.closest('.read-more-btn-list')) {
                        const url = this.dataset.postUrl || clickUrl;
                        window.location.href = url;
                    }
                });

                // Prevent row hover when hovering over button
                const readMoreBtn = listItem.querySelector('.read-more-btn-list');
                if (readMoreBtn) {
                    readMoreBtn.addEventListener('mouseenter', function(e) {
                        e.stopPropagation();
                        listItem.classList.add('button-hovering');
                    });
                    
                    readMoreBtn.addEventListener('mouseleave', function(e) {
                        e.stopPropagation();
                        listItem.classList.remove('button-hovering');
                    });
                }
            });
        }

        else {
            // Reset to grid view - convert back to div if needed
            if (container.tagName === 'UL') {
                const newDiv = document.createElement('div');
                newDiv.className = 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6';
                newDiv.id = 'posts-container';
                
                while (container.firstChild) {
                    newDiv.appendChild(container.firstChild);
                }
                
                container.parentNode.replaceChild(newDiv, container);
                container = newDiv;
            } else {
                container.className = 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6';
            }

            // Reset post items for grid view - get all items (li or article)
            const postItems = container.querySelectorAll('li, article, .post-item');

            postItems.forEach(item => {
                // Restore original structure if saved and it's an li
                if (item.tagName === 'LI' && item.dataset.originalStructure) {
                    // Parse and restore the original article element
                    const tempDiv = document.createElement('div');
                    tempDiv.innerHTML = item.dataset.originalStructure;
                    const originalArticle = tempDiv.firstElementChild;
                    
                    if (originalArticle) {
                        // Remove list classes and restore article
                        originalArticle.classList.remove('list-row', 'list-clickable');
                        originalArticle.style.cursor = '';
                        
                        // Preserve the originalStructure for future toggles
                        if (item.dataset.originalStructure) {
                            originalArticle.dataset.originalStructure = item.dataset.originalStructure;
                        }
                        
                        // Replace li with restored article
                        item.parentNode.replaceChild(originalArticle, item);
                    }
                } else if (item.tagName === 'ARTICLE') {
                    // Article - just ensure classes are correct
                    item.classList.remove('list-row', 'list-clickable');
                    item.style.cursor = '';
                    
                    // If no originalStructure saved, save it now
                    if (!item.dataset.originalStructure) {
                        item.dataset.originalStructure = item.outerHTML;
                    }
                }
            });
        }
    }

    // Start initialization
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initTheme);
    } else {
        // DOM already loaded
        initTheme();
    }
})();
