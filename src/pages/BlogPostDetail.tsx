import React from 'react';
import { useParams } from 'react-router-dom';

const BlogPostDetail: React.FC = () => {
  const { id } = useParams<{ id: string }>();

  return (
    <div className="p-4">
      <h1 className="text-2xl font-bold">Blog Post Details</h1>
      <p className="mt-2">
        You are viewing the details for blog post ID: <span className="font-mono text-lg">{id}</span>
      </p>
    </div>
  );
};

export default BlogPostDetail;