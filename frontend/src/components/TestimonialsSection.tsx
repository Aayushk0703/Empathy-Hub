import { motion } from "framer-motion";

const testimonials = [
  {
    image: "/app/testimonials/Screenshot 2026-05-02 095525.png",
    alt: "Testimonial 1",
  },
  {
    image: "/app/testimonials/Screenshot 2026-05-02 095543.png",
    alt: "Testimonial 2",
  },
  {
    image: "/app/testimonials/Screenshot 2026-05-02 095557.png",
    alt: "Testimonial 3",
  },
  {
    image: "/app/testimonials/Screenshot 2026-05-02 095609.png",
    alt: "Testimonial 4",
  },
];

const TestimonialsSection = () => {
  return (
    <section className="pt-32 pb-20 px-4 bg-secondary/40">
      <div className="max-w-6xl mx-auto">
        <motion.div
          initial={{ opacity: 0, y: 20 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
          className="text-center mb-14"
        >
          <h2 className="font-heading text-3xl md:text-5xl text-foreground">
            Stories of <span className="font-bold text-primary">Transformation</span>
          </h2>
          <p className="font-body text-muted-foreground mt-4 max-w-2xl mx-auto">
            Hear from our clients about their journey to mental wellness
          </p>
        </motion.div>

<div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
          {testimonials.map((t, i) => (
            <motion.div
              key={i}
              initial={{ opacity: 0, y: 20 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true }}
              transition={{ delay: i * 0.1 }}
              className="bg-card rounded-2xl p-3 border-2 border-primary/20 shadow-lg hover:shadow-xl hover:border-primary/40 transition-all duration-300"
            >
              <img
                src={t.image}
                alt={t.alt}
                className="w-full h-[200px] md:h-[220px] lg:h-[250px] rounded-xl object-cover"
              />
            </motion.div>
          ))}
        </div>
      </div>
    </section>
  );
};

export default TestimonialsSection;
