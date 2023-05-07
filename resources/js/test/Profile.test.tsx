/**
 * @jest-environment jsdom
 */
import renderer from 'react-test-renderer';
import Profile from '../components/Profile';
import React from 'react';

it('renders correctly', () => {
    const tree = renderer
    .create(<Profile userName={'Taehong'} userEmail={'minth1123@icloud.com'} signupDate={'Today'} editProfile={null} />)
    .toJSON();
    expect(tree).toMatchSnapshot();
})