import React from 'react'
import ImageComponent from '../../partial/Component/ImageComponent';
const ServiceBox = ({data}) => {
  return (
    <div className="col-lg-4 col-6" key={data.id} >
      <div className="serviceItem">
        <ImageComponent src={data.image} alt={data.title}/>
        <div className="serviceItemTitle">
          <h3>{data.title}</h3>
          <p>
            {data.text}
          </p>
        </div>
        <a href="#url" className="servicelnk"></a>
      </div>
    </div>
  )
}

export default ServiceBox 