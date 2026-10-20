import React from 'react'
import { BASE_IMAGE_URL } from '../../../config'

const ImageComponent = ({src,alt="image",className="",style={}}) => {
  return (
    <img
              src={`${BASE_IMAGE_URL}${src}`}
              alt={alt}
              className={className}
              style={style}
            />
  )
}

export default ImageComponent