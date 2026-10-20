
import ImageComponent from '../../partial/Component/ImageComponent';
import { Markup } from 'interweave';
export const Banner = ({data}) => {
  return (
    <div className="bnersec inrBner">
      <div className="bnerimge">
        <ImageComponent src={data.image} alt="Network Banner"/>
        <div className="bnertxt">
          <div className="container">
            <div className="bnertxtinr">
               <h1>{data.title}</h1>              
            </div>
          </div>
        </div>
      </div>
    </div>
  )
}
