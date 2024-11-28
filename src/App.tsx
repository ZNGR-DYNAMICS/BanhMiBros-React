import React from 'react';
import { BrowserRouter as Router, Route, Routes } from 'react-router-dom';
import Home from './components/Home';
import About from './components/About';
import BlogPost from './components/BlogPost';
import BlogPostDetail from './pages/BlogPostDetail';

const App: React.FC = () => {
  return (
    <Router>
      <div>
        <Routes>
          <Route path="/" element={<Home />} />
          <Route path="/about" element={<About />} />
          <Route path="/blogpost" element={<BlogPost />} />
          <Route path="/blogpost/:id" element={<BlogPostDetail />} />
        </Routes>
      </div>
    </Router>
  );
};

export default App;