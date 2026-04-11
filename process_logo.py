from PIL import Image

def process_logo(input_path, output_path):
    # Open the image
    img = Image.open(input_path).convert("RGBA")
    
    # Get image dimensions
    width, height = img.size
    
    # 1. REMOVE BACKGROUND
    # Assume the top-left pixel is the background color
    bg_color = img.getpixel((0, 0))
    
    # We will make anything close to bg_color transparent
    data = img.getdata()
    new_data = []
    
    # Tolerance for background removal
    tolerance = 30
    
    for item in data:
        # Check if pixel is similar to bg_color
        r, g, b, a = item
        if (abs(r - bg_color[0]) < tolerance and 
            abs(g - bg_color[1]) < tolerance and 
            abs(b - bg_color[2]) < tolerance):
            new_data.append((255, 255, 255, 0)) # transparent
        else:
            new_data.append(item)
            
    img.putdata(new_data)
    
    # 2. CROP OUT TEXT
    # Assuming text is on the right side. We'll crop to a square aspect ratio from the left.
    # The logo mark is usually roughly a square on the left.
    size = min(width, height)
    # We'll just define the bounding box for the left-most square
    left = 0
    top = 0
    right = size # Since we want the logo, we assume it's a square on the left
    bottom = size
    
    img = img.crop((left, top, right, bottom))
    
    # Save the processed image
    img.save(output_path, "PNG")

if __name__ == "__main__":
    process_logo("public/logo.png", "public/logo.png")
    print("Logo processed successfully")
