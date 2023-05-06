import React from 'react';
import { createRoot } from 'react-dom/client';

type ProfileProps = {
    userName: string
    userEmail: string
    signupDate: string
    editProfile: string | null
}

function Profile({ userName, userEmail, signupDate, editProfile } : ProfileProps) {
    return (
        <div className="card">
            <div className="card-body">
                <h5 className="card-title">
                    <a href={`/admin/users/${editProfile}`} rel="noopener noreferrer" className="text-dark">{userName}</a>
                </h5>
                <h6 className="card-subtitle mb-2 text-muted">{userEmail}</h6>
                <h6 className="card-subtitle mb-2 text-muted">{`Joined ${signupDate}`}</h6>
            </div>
        </div>
    );
}

export default Profile;

if (document.getElementById('profile')) {
    const container: HTMLElement | null = document.getElementById('profile');

    if(container) {
        const userName: string | null = container.getAttribute('userName');
        const userEmail: string | null = container.getAttribute('userEmail');
        const signupDate: string | null = container.getAttribute('signupDate');
        const editProfile: string | null = container.getAttribute('editProfile');
        const root = createRoot(container);
        if(userName && userEmail && editProfile && signupDate) {
            root.render(<Profile userName={userName} userEmail={userEmail} signupDate={signupDate} editProfile={editProfile}/>);
        }
    }
}
