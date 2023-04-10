import React, {useState} from 'react';
import ReactDOM from 'react-dom';
import './Example.css';


function Example() {
    return (
        <div className="container">
            <div className="row justify-content-center">
                <div className="col-md-8">
                    <div className="card">
                        <div>
                            <a href="posts/create">
                                <button type="submit" className='create-post'>
                                    <span className="create-button-title">Upload your cat!</span>
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default Example;

if (document.getElementById('example')) {
    ReactDOM.render(<Example />, document.getElementById('example'));
}
