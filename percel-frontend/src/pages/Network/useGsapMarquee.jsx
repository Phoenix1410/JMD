import { useEffect, useRef } from "react";
import { gsap } from "gsap";

export const useGsapMarquee = ({
  speed = 50,
  direction = "ltr",
  pauseOnHover = true,
}) => {
  const marqueeRef = useRef(null);

  useEffect(() => {
    const marquee = marqueeRef.current;
    if (!marquee) return;

    const inner = marquee.querySelector(".marqueeInner");

    // Duplicate content ONCE
    inner.innerHTML += inner.innerHTML;

    const totalWidth = inner.scrollWidth / 2;

    let tween = gsap.to(inner, {
      x: direction === "ltr" ? -totalWidth : totalWidth,
      duration: totalWidth / speed,
      ease: "none",
      repeat: -1,
      modifiers: {
        x: gsap.utils.unitize((x) => {
          let value = parseFloat(x);
          if (direction === "ltr") {
            return value % -totalWidth;
          } else {
            return value % totalWidth;
          }
        }),
      },
    });

    if (pauseOnHover) {
      marquee.addEventListener("mouseenter", () => tween.pause());
      marquee.addEventListener("mouseleave", () => tween.resume());
    }

    return () => {
      tween.kill();
    };
  }, [speed, direction, pauseOnHover]);

  return marqueeRef;
};