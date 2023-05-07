/**
 * @jest-environment jsdom
 */
import renderer from 'react-test-renderer';
import PostImage from '../components/PostImage';
import React from 'react';


it('renders correctly', () => {
    const tree = renderer
    .create(<PostImage />)
    .toJSON();
    expect(tree).toMatchSnapshot();
})
