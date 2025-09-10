<?php
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>About - Tech & Innovation Forum</title>
  <link rel="stylesheet" href="style1.css" />
</head>
<body>
  <?php include 'header.php'; ?>

  <main>
    <section class="hero" style="background-image: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1497215842964-222b430dc094?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80')">
      <h1>About Our Community</h1>
      <p>
        Learn about our mission, values, and the team behind the Tech & Innovation Forum
      </p>
    </section>

    <section class="about-section" style="padding: 50px 20px;">
      <div style="max-width: 1000px; margin: 0 auto;">
        <div style="display: flex; flex-wrap: wrap; gap: 40px; align-items: center; margin-bottom: 50px;">
          <div style="flex: 1; min-width: 300px;">
            <h2 class="section-title">Our Mission</h2>
            <p style="font-size: 1.1rem; line-height: 1.8; margin-bottom: 20px;">
              At the GCTU Connect Forum, our mission is to create a vibrant community where technology enthusiasts, professionals, and innovators can connect, collaborate, and drive technological progress forward. We believe that by sharing knowledge and fostering meaningful discussions, we can accelerate innovation and solve complex challenges.
            </p>
            <p style="font-size: 1.1rem; line-height: 1.8;">
              We're committed to building an inclusive environment where diverse perspectives are valued and everyone feels empowered to contribute to the conversation about technology's role in shaping our future.
            </p>
          </div>
          <div style="flex: 1; min-width: 300px;">
            <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Team Collaboration" style="width: 100%; border-radius: 8px; box-shadow: 0 10px 30px rgba(0,0,0,0.15);">
          </div>
        </div>
        
        <h2 class="section-title">Our Values</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px; margin-top: 30px;">
          <div style="background: #f8f9ff; padding: 25px; border-radius: 8px; text-align: center;">
            <div style="font-size: 3rem; color: var(--primary); margin-bottom: 15px;">🤝</div>
            <h3 style="color: var(--primary); margin-bottom: 15px;">Collaboration</h3>
            <p>We believe that together we can drive significant advancements in technology and innovation.</p>
          </div>
          
          <div style="background: #f8f9ff; padding: 25px; border-radius: 8px; text-align: center;">
            <div style="font-size: 3rem; color: var(--primary); margin-bottom: 15px;">💡</div>
            <h3 style="color: var(--primary); margin-bottom: 15px;">Innovation</h3>
            <p>Our goal is to keep pace with the ever-changing world of technology and foster creative thinking.</p>
          </div>
          
          <div style="background: #f8f9ff; padding: 25px; border-radius: 8px; text-align: center;">
            <div style="font-size: 3rem; color: var(--primary); margin-bottom: 15px;">🌍</div>
            <h3 style="color: var(--primary); margin-bottom: 15px;">Inclusivity</h3>
            <p>Everyone is welcome to share their voice and expertise regardless of background or experience level.</p>
          </div>
        </div>
      </div>
    </section>
    
    <section style="background: linear-gradient(135deg, var(--primary), var(--secondary)); color: white; padding: 70px 20px; text-align: center;">
      <div style="max-width: 800px; margin: 0 auto;">
        <h2 style="font-size: 2rem; margin-bottom: 20px;">Join Our Growing Community</h2>
        <p style="font-size: 1.2rem; margin-bottom: 30px;">
          Become part of a network of passionate individuals shaping the future of technology.
        </p>
        <a href="register.php" class="btn" style="background: white; color: var(--primary);">Create a Thread</a>
      </div>
    </section>
  </main>

<?php include 'footer.php'; ?>
</body>
</html>