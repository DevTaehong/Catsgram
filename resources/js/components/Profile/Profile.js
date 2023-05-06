import React, {useState} from 'react';
import { createRoot } from 'react-dom/client';


function Profile({ userName, userEmail, signupDate, editProfile }) {
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
    const container = document.getElementById('profile');
    const root = createRoot(container);
    let userName = document.getElementById('profile').getAttribute('userName');
    let userEmail = document.getElementById('profile').getAttribute('userEmail');
    let signupDate = document.getElementById('profile').getAttribute('signupDate');
    let editProfile = document.getElementById('profile').getAttribute('editProfile');
    root.render(<Profile userName={userName} userEmail={userEmail} signupDate={signupDate} editProfile={editProfile}/>);
}
