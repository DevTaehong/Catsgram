import React from 'react';
import { createRoot } from 'react-dom/client';

function PostImage() {
    return (
        <div className="card">
            <div>
                <a href="posts/create">
                    <button type="submit" className='create-post'>
                        <span className="create-button-title">Upload your cat!</span>
                    </button>
                </a>
            </div>
        </div>
    );
}

export default PostImage;

if (document.getElementById('postImage')) {
    const container: HTMLElement | null = document.getElementById('postImage');
    if (container) {
        const root = createRoot(container);
        root.render(<PostImage />);
    }
}
