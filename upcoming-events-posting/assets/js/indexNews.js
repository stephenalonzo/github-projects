fetch('news.json')
    .then(response => response.json())
    .then(data => {


        //Sort all posts from 
        const sortPosts = data.sort((a, b) => new Date(a.blogDate) - new Date(b.blogDate));

        // Get the last 4 announcements in the array
        const lastFourAnnouncements = sortPosts.slice(-5);

        const container = document.getElementById('announcementContainer');

        //Loop through the 4 and reorder it so that the last one is displayed first then i-- so it displays in reverse order.
        for (let i = lastFourAnnouncements.length - 1; i >= 0; i--) {
            const item = lastFourAnnouncements[i];
            const blogPost = document.createElement('div');
            blogPost.classList.add('blog-post', 'card', 'card-announcements', 'mb-3');
            blogPost.innerHTML = `
                            <div class="row g-0">
                                <div class="col-md-4 my-auto fema-blog-index">
                                    <img src="${item.blogThumb}" class="img-fluid d-block mx-auto" alt="${item.blogTitle}" />
                                </div>
                                <div class="col-md-8 container my-auto">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            ${item.blogTitle}
                                        </h5>
                                        <p class="card-text">
                                            <small class="text-muted">${item.blogDate}</small>
                                        </p>
                                        <p class="card-text">
                                           ${item.blogDesc}
                                        </p>
                                        <a href="${item.blogPath}" class="btn btn-primary">Read
                                            More</a>
                                    </div>
                                </div>
                            </div>`;
            container.appendChild(blogPost);
        }
    })
    .catch(error => console.error(error));
