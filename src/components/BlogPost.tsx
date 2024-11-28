import React from 'react';
import { Link } from 'react-router-dom';

const BlogPost: React.FC = () => {
  const posts = [
    { id: '1', title: 'React Basics' },
    { id: '2', title: 'Understanding TypeScript' },
    { id: '3', title: 'Styling with Tailwind' },
  ];

  return (
    <div className="p-4">
      <h1 className="text-2xl font-bold">Blog Posts</h1>
      <ul className="mt-4 space-y-2">
        {posts.map((post) => (
          <li key={post.id}>
            <Link to={`/blogpost/${post.id}`} className="text-blue-500 hover:underline">
              {post.title}
            </Link>
          </li>
        ))}
      </ul>
    </div>
  );
};

export default BlogPost;