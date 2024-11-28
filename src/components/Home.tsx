import React from 'react';
import { Link } from 'react-router-dom';

const Home: React.FC = () => {
  return (
    <div className="p-4">
      <h1 className="text-2xl font-bold">Welcome to the Homepage!</h1>
      <nav className="mt-4 space-x-4">
        <Link to="/about" className="text-blue-500 hover:underline">About</Link>
        <Link to="/blogpost" className="text-blue-500 hover:underline">Blog</Link>
      </nav>
    </div>
  );
};

export default Home;