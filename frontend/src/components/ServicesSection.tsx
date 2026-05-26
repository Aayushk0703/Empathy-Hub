import { useEffect, useState } from "react";
import { motion } from "framer-motion";
import individualImg from "@/assets/individual-therapy.jpg";
import couplesImg from "@/assets/couples-therapy.jpg";
import teenImg from "@/assets/teen-therapy.jpg";
import psychiatricImg from "@/assets/psychiatric-therapy.jpg";
import { apiRequest } from "@/lib/api";

const fallbackServices = [
  { title: "Individual Therapy", image: individualImg },
  { title: "Couples Therapy", image: couplesImg },
  { title: "Teen Therapy", image: teenImg },
  { title: "Psychiatric Therapy", image: psychiatricImg },
];

const ServicesSection = () => {
  const [services, setServices] = useState(fallbackServices);

  useEffect(() => {
    let active = true;

    const loadServices = async () => {
      try {
        const data = await apiRequest<{
          services: Array<{ title: string }>;
        }>("/services");

        if (active && data.services.length > 0) {
          setServices(
            data.services.slice(0, 4).map((service, index) => ({
              title: service.title,
              image: fallbackServices[index % fallbackServices.length].image,
            }))
          );
        }
      } catch {
        // Keep the section usable with local fallback content.
      }
    };

    void loadServices();

    return () => {
      active = false;
    };
  }, []);

  return (
    <section id="services" className="py-20 px-4">
      <div className="max-w-6xl mx-auto">
        <motion.div
          initial={{ opacity: 0, y: 20 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
          className="text-center mb-14"
        >
          <p className="text-muted-foreground font-body text-lg">Discover the right</p>
          <h2 className="font-heading text-3xl md:text-5xl text-foreground mt-1">
            Support for your <span className="font-bold">Journey</span>
          </h2>
        </motion.div>

        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
          {services.map((service, i) => (
            <motion.div
              key={service.title}
              initial={{ opacity: 0, y: 30 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true }}
              transition={{ delay: i * 0.1 }}
              whileHover={{ y: -8 }}
              className="group rounded-2xl overflow-hidden bg-card border border-border"
            >
              <div className="aspect-[3/4] overflow-hidden">
                <img
                  src={service.image}
                  alt={service.title}
                  className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                  loading="eager"
                  width={640}
                  height={854}
                />
              </div>
              <div className="p-4">
                <h3 className="font-heading text-lg text-foreground">{service.title}</h3>
              </div>
            </motion.div>
          ))}
        </div>
      </div>
    </section>
  );
};

export default ServicesSection;
