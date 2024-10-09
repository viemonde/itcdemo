import React, { useState, useEffect } from 'react';

const AboutUs = () => {
  const [data, setData] = useState(null);

  useEffect(() => {
    fetch('/jsonapi/node/page/2')
      .then((response) => {
        if (!response.ok) {
          throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
      })
      .then((data) => {
        console.log('Fetched data:', data); // Add this line for debugging
        // Ensure this structure matches the API response
        if (data && data.data && data.data[0]) {
          setData(data.data[0]);
        }
      })
      .catch((error) => console.error('Error fetching content:', error));
  }, []);

  return data ? (
    <div>
      <h1>{data.attributes?.title}</h1>
      <div dangerouslySetInnerHTML={{ __html: data.attributes?.body?.value }} ></div>
    </div>
  ) : (
    Loading...
  );
};

export default AboutUs;
