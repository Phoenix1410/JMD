import { useState } from "react";
import ImageComponent from "../../partial/Component/ImageComponent";

export default function TestimonialSlider({ testimonials }) {
  const [current, setCurrent] = useState(2);
  const [fade, setFade] = useState(false);

  const total = testimonials.length;

  const prev = () => {
    setFade(true);
    setTimeout(() => {
      setCurrent((prev) => (prev - 1 + total) % total);
      setFade(false);
    }, 200);
  };

  const next = () => {
    setFade(true);
    setTimeout(() => {
      setCurrent((prev) => (prev + 1) % total);
      setFade(false);
    }, 200);
  };

  const getClass = (index) => {
    if (index === current) return "testimonial-card slide active";
    if (index === (current - 1 + total) % total)
      return "testimonial-card slide left-1";
    if (index === (current - 2 + total) % total)
      return "testimonial-card slide left-2";
    if (index === (current + 1) % total)
      return "testimonial-card slide right-1";
    if (index === (current + 2) % total)
      return "testimonial-card slide right-2";
    return "testimonial-card slide";
  };

  return (
    <section className="testimonial-section">
      <div className="container">
        <h3 className="testimonial-title">Over 1000 People Trust us</h3>

        <div className="testimonial-wrapper">
          <div className="arrow left" onClick={prev}>
            &#10094;
          </div>

          {testimonials.map((item, index) => (
            <div key={index} className={getClass(index)}>
              <ImageComponent src={item.image} alt={item.name} />
            </div>
          ))}

          <div className="arrow right" onClick={next}>
            &#10095;
          </div>
        </div>

        <div className={`testimonial-content ${fade ? "fade" : ""}`}>
          <p>{testimonials[current].message}</p>

          <h6>{testimonials[current].name}</h6>

          <span>{testimonials[current].designation}</span>
        </div>
      </div>
    </section>
  );
}
