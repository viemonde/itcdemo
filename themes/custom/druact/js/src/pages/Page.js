import React, { useState, useEffect } from 'react';
const Page = ({ alias, lang }) => {
  const [data, setData] = useState(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    if (alias) {
      const cleanAlias = alias.startsWith('/') ? alias.slice(1) : alias;
      let baseUrl = window.location.origin; 
      if (lang) {
        baseUrl += '/' + lang;
      }
      fetch(`${baseUrl}/jsonapi/content/path?path=/${cleanAlias}`)
        .then((response) => response.json())
        .then((nodeData) => {
          setData(nodeData.data);
          setLoading(false);
        })
        .catch((error) => {
          console.error('Error fetching content:', error);
          setLoading(false);
        });
    }
  }, [alias, lang]);

  if (loading) {
    return <div>Loading...</div>; // Render loading state
  }

  if (!data) {
    return <div>No data found</div>; // Render message if no data found
  }

  return (
    <div>
      {data.attributes.title && data.attributes.title.trim() !== '' && (
        <h1>{data.attributes.title}</h1>
      )}
      <div dangerouslySetInnerHTML={{ __html: data.attributes.body.value }}></div>
    </div>
  );
};

export default Page;
